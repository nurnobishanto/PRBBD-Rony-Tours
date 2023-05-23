<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Msg;
use App\Models\Subscriber;
use App\Models\Support;
use App\Models\SupportDepartment;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::all();
        return view('admin.subscribers.index',compact('subscribers'));
    }
    public function supports(){
        $data = array();
        $data['supports'] = Support::where('user_id',auth('web')->user()->id)->orderBy('id','DESC')->get();
        $data['departments'] = SupportDepartment::all();
        return view('frontend.user.support',$data);
    }
    public function admin_supports(){
        $data = array();
        $data['supports'] = Support::orderBy('id','DESC')->get();
        $data['departments'] = SupportDepartment::all();
        return view('admin.supports.index',$data);
    }
    public function support_create(Request $request){
        $request->validate([
            'support_department_id' => 'required',
            'subject' => 'required',
            'msg' => 'required'
        ]);
        $support = Support::create([
            'support_department_id' => $request->support_department_id,
            'subject' => $request->subject,
            'status' => 1,
            'user_id' => auth('web')->user()->id
        ]);
        Msg::create([
            'support_id' => $support->id,
            'body' => $request->msg,
            'sender' => 1,
        ]);
        toastr()->success('Ticket created successfully');
        return redirect()->back();
    }
    public function support_chat($id){
        $data = array();
        $data['chats'] = Msg::where('support_id',$id)->get();
        $data['support'] =Support::find($id) ;
        return view('frontend.user.chat',$data);
    }
    public function admin_support_chat($id){
        $data = array();
        $data['chats'] = Msg::where('support_id',$id)->get();
        $data['support'] =Support::find($id) ;
        return view('admin.supports.chat',$data);
    }
    public function send_msg(Request $request,$id){
         $request->validate([
             'msg' => 'required'
         ]);
        Msg::create([
            'support_id' => $id,
            'body' => $request->msg,
            'sender' => 1,
        ]);
        toastr()->success('Message sent successfully');
        return redirect()->back();
    }
    public function admin_chat_send(Request $request,$id){
        $request->validate([
            'msg' => 'required'
        ]);
        Msg::create([
            'support_id' => $id,
            'body' => $request->msg,
            'sender' => 0,
        ]);
        toastr()->success('Message sent successfully');
        return redirect()->back();
    }

    public function chat_end($id){

        $support = Support::find($id) ;
        $support->status = 0;
        $support->update();
        toastr()->success('Support closed successfully');
        return redirect()->back();
    }
    public function admin_chat_open($id){

        $support = Support::find($id) ;
        $support->status = 1;
        $support->update();
        toastr()->success('Support closed successfully');
        return redirect()->back();
    }
    public function admin_chat_end($id){

        $support = Support::find($id) ;
        $support->status = 0;
        $support->update();
        toastr()->success('Support closed successfully');
        return redirect()->back();
    }
}
