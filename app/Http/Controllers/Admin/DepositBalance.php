<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;

class DepositBalance extends Controller
{
    use FileUpload;


    public function create()
    {
        $users = User::all();
        return view('admin.deposits.create', compact('users'));
    }

    public function store(Request $request)
    {


        $input = $request->validate([
            'user_id'=>'required|exists:users,id',
            'amount'=>'required|numeric',
            'trxid'=>'required|string',
            'slip'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'note'=>'nullable|string'
        ]);

            $user = User::find($request->user_id);
            $user->increment('balance', $request->amount);
            $input['paid_by'] = 'Fund added by '.auth('admin')->user()->name;
            if($request->has('slip')){
                $input['slip'] = $this->uploadFile($request->file('slip'), 'deposit');
            }
            $input['currency'] = 'BDT';
            $input['status'] = 'success';
            $input['note'] = $request->note;
            Deposit::create($input);
            addTrans($request->trxid,'Add Fund',$request->amount,$input['paid_by'],$input['note'],$input['status']);
            return redirect()->back()->with('success', "Successful");

    }

    public function refunds(){
        $data = array();
        $data['refunds'] = Refund::all();
        return view('admin.refunds.index',$data);
    }
    public function refund_create(){
        $users = User::all();
        return view('admin.refunds.create',compact('users'));
    }
    public function get_user_orders(Request $request){
        $data = Order::where('user_id',$request->input('user_id'))->get();
        return response()->json($data);
    }
    public function refund_store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'amount' => 'required',
            'trxid' => 'required',
        ]);
        $input = $request->all();
        $order = Order::find($request->order_id);
        $user = User::find($request->user_id);
        if($order->paid_amount < $request->amount){
            toastr()->warning('Refund amount is larger than order paid amount');
            return redirect()->back();
        }
        $user->increment('balance', $request->amount);
        $order->decrement('paid_amount', $request->amount);
        $input['paid_by'] = 'Refund by '.auth('admin')->user()->name;
        $input['currency'] = 'BDT';
        $input['status'] = 'success';
        $input['note'] = $request->note;
        Refund::create($input);
        addTrans($request->trxid,'Refund',$request->amount,$input['paid_by'],$input['note'],$input['status']);
        return redirect()->back()->with('success', "Successful");
    }
    public function bank_deposit($id){
        $bank = Bank::find($id);
        $user = auth('web')->user();
        return view('frontend.bank_deposit',compact('bank','user'));
    }
    public function bank_deposit_submit(Request $request,$id){
        $bank = Bank::find($id);
        $user = auth('web')->user();
        $request->validate([
            'amount' => 'required',
            'trxid' => 'required',
            'slip' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->file('slip')) {
            $imageName = time().'.'.$request->file('slip')->extension();
            $request->file('slip')->move(public_path('images'), $imageName);
        }

        Deposit::create([
                 'user_id' => $user->id,
                 'amount' => $request->amount - ($request->amount * ($bank->charge / 100)),
                 'paid_by' => 'Manually Deposit from '.$bank->bank_name,
                 'trxid' => $request->trxid,
                 'status' => 'pending',
                 'slip' => $imageName,
                 'currency' => 'BDT',
                 'note' => $request->note,
        ]);
        toastr()->success('Deposit added and waiting for approval');
        return redirect(route('user.dashboard'));
    }
    public function bank_deposit_store(Request $request){
        $request->validate([
            'bank_id' => 'required',
            'amount' => 'required|numeric|min:10',
            'service' => 'required',
            'trxid' => 'required',
            'terms' => 'required',
            'slip' => 'required|image|max:2048|mimes:jpeg,png',
        ]);
        $bank = Bank::find($request->bank_id);
        $user = auth('web')->user();

        if ($request->file('slip')) {
            $imageName = time().'.'.$request->file('slip')->extension();
            $request->file('slip')->move(public_path('images'), $imageName);
        }

        Deposit::create([
            'user_id' => $user->id,
            'amount' => $request->amount - ($request->amount * ($bank->charge / 100)),
            'paid_by' => 'Manually '.$request->amount .'BDT Deposit from '.$bank->bank_name,
            'trxid' => $request->trxid,
            'status' => 'pending',
            'slip' => $imageName,
            'currency' => 'BDT',
            'note' => $request->service,
        ]);
        toastr()->success('Deposit added and waiting for approval');
        return redirect(route('deposit'));

    }
}
