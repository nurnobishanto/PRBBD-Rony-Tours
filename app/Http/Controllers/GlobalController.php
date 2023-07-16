<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Bank;
use App\Models\Deposit;
use App\Models\EmailLog;
use App\Models\Passenger;
use App\Models\SmsLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GlobalController extends Controller
{
   public function transactions(){
       $data = array();
       $data['trans'] = Transaction::orderBy('created_at','DESC')->get();
       return view('admin.logs.trans',$data);
   }
    public function emails(){
        $data = array();
        $data['emails'] = EmailLog::all();
        return view('admin.logs.emails',$data);
    }
    public function sms(){
        $data = array();
        $data['logs'] = SmsLog::all();
        return view('admin.logs.sms',$data);
    }
    public function send_email(){
        return view('admin.logs.send_email');
    }
    public function send_sms(){
        return view('admin.logs.send_sms');
    }
    public function email_send(Request $request){
       $request->validate([
           'to' => 'email',
           'subject' => 'required',
           'body' => 'required',
       ]);

        $dynamicData = [
            'body' => $request->body,
        ];
        $subject = $request->subject;
        $body = $request->body;
        $from = env('MAIL_FROM_ADDRESS');
        $to = $request->to;
        if(Mail::to($to)->send(new SendEmail($dynamicData,$subject))){
            addEmailLog($from,$to,$subject,$body,'success');
            toastr()->success('Email sent success');
        }else{
            addEmailLog($from,$to,$subject,$body,'failed');
            toastr()->success('Email sent failed');
        }

       return redirect()->back();

    }
    public function sms_send(Request $request){
       $request->validate([
           'to' => 'required|numeric',
           'msg' => 'required',
       ]);
       send_sms($request->to,$request->msg,'Custom');
       return redirect()->back();
    }
    public function passenger_update(Request $request){

       $validation = $request->validate([
           'pid' => 'required',
           'title' => 'required',
           'first_name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'DateOfBirth' => 'required',
           'gender' => 'required',
           'address' => 'required',
           'pax_type' => 'required',
       ]);
        $passenger = Passenger::find($request->pid);
        $order = $passenger->orders->first();
        $travel = $order->to();
        $expdate = date('Y-m-d',strtotime( $travel->arrival_time));

        if($request->passport_mandatory){
            if($request->passport_expire_date < $expdate){
                toastr()->warning('Invalid Passport Expire date','Invalid Expire date('.$i.')');
                return redirect()->back()->withInput();
            }
        }

        if (!preg_match('/^[A-Za-z]{2,}$/', $request->first_name)) {
            toastr()->warning('Invalid First name','Invalid First Name');
            return redirect()->back()->withInput();
        }
        if (!preg_match('/^[A-Za-z]{2,}$/', $request->last_name)) {
            toastr()->warning('Invalid last name','Invalid last Name');
            return redirect()->back()->withInput();
        }
        if($request->pax_type == 'Infant'){
            if(calculateAge(date('Y-m-d',strtotime($request->DateOfBirth)))>2){
                toastr()->warning('Invalid Infant date of birth','Invalid DOB');
                return redirect()->back()->withInput();
            }
        }
        if($request->pax_type == 'Child'){
            if(calculateAge(date('Y-m-d',strtotime($request->DateOfBirth)))>12 || calculateAge(date('Y-m-d',strtotime($request->$dob)))<2){
                toastr()->warning('Invalid Child date of birth','Invalid DOB ');
                return redirect()->back()->withInput();
            }
        }
        if($request->pax_type == 'Adult'){
            if(calculateAge(date('Y-m-d',strtotime($request->DateOfBirth)))<12){
                toastr()->warning('Invalid Adult date of birth','Invalid DOB');
                return redirect()->back()->withInput();
            }
        }

        if ($request->title == 'Mstr' || $request->title == 'Mr'){
            if($request->gender == 'Female'){
                toastr()->warning('Invalid Gender for title','Invalid Gender');
                return redirect()->back()->withInput();
            }
        }
       if ($request->gender =='Female'){
           if ($request->title == 'Mr' || $request->title == 'Mstr'){
               toastr()->warning('Gender does not match title!');
               return redirect()->back();
           }
       }else {
           if ($request->title == 'Ms' || $request->title == 'Miss' || $request->title == 'Mrs'){
               toastr()->warning('Gender does not match title!');
               return redirect()->back();
           }
       }

       if($validation){

           if ($passenger){
               $passenger->title = $request->title;
               $passenger->first_name = $request->first_name;
               $passenger->last_name = $request->last_name;
               $passenger->email = $request->email;
               $passenger->dob = $request->DateOfBirth;
               $passenger->passport_no = $request->passport_no;
               $passenger->passport_expire_date = $request->passport_expire_date;
               $passenger->gender = $request->gender;
               $passenger->address = $request->address;
               $passenger->update();
               toastr()->success('Passenger updated!');
           }else{
               toastr()->error('Passenger not found!');
           }
       }else{
           toastr()->error('validation error');
       }
       return redirect()->back();


    }

    public function deposit(){
       $data = array();
       $data['banks'] = Bank::all();
       $data['deposits'] = Deposit::where('user_id',auth('web')->user()->id)->orderBy('id','desc')->get();
       return view('frontend.deposit',$data);
    }

}
