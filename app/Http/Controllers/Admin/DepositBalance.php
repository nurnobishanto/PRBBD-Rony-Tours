<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\DB;

class DepositBalance extends Controller
{
    use FileUpload;

    public function index(){
        $data = array();
        $data['deposits'] = Deposit::all();
        return view('admin.deposits.index', $data);
    }

    public function create()
    {
        $users = User::all();
        return view('admin.deposits.create', compact('users'));
    }

    public function store(Request $request)
    {
        // return $request;

        $input = $request->validate([
            'user_id'=>'required|exists:users,id',
            'amount'=>'required|numeric',
            'trxid'=>'required|string',
            'slip'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'note'=>'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $user = User::find($request->user_id);

            if($request->deposit_type == 'cradit')
            {
                $user->increment('balance', $request->amount);
                $input['paid_by'] = 'Fund added by '.auth()->name;
            } elseif($request->deposit_type == 'debit') {
                if($user->balance >= $request->amount)
                {
                    $user->decrement('balance', $request->amount);
                    $input['paid_by'] = 'Fund withdraw by '.auth()->name;
                } else {
                    return redirect()->back()->with('warning', "You have not enough balance");
                }
            } else {

            }

            if($request->has('slip')){
                $input['slip'] = $this->uploadFile($request->file('slip'), 'deposit');
            }

            $input['currency'] = 'BDT';
            $input['status'] = 'success';
            // return $input;
            Deposit::create($input);

            DB::commit();
            return redirect()->back()->with('success', "Successful");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
