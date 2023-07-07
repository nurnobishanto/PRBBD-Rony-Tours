<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\EmailLog;
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

}
