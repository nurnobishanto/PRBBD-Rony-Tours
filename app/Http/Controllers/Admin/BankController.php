<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::get();
        return view('admin.bank.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.bank.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'operator' => 'required|numeric',
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string',
            'account_no' => 'required|string',
            'branch_name' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'routing_no' => 'nullable|string',
            'charge_info' => 'nullable|string',
            'charge' => 'nullable|numeric',
            'operator_type' => 'nullable|numeric',
        ]);

        Bank::create($input);

        return redirect()->back()->with('success', 'Bank Create Successfully');
    }

    public function edit(Bank $bank)
    {
        return view('admin.bank.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $input = $request->validate([
            'operator' => 'required|numeric',
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string',
            'account_no' => 'required|string',
            'branch_name' => 'nullable|string',
            'swift_code' => 'nullable|string',
            'routing_no' => 'nullable|string',
            'charge_info' => 'nullable|string',
            'charge' => 'nullable|numeric',
            'operator_type' => 'nullable|numeric',
        ]);

        $bank->update($input);

        return redirect()->back()->with('success', 'Bank Update Successfully');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->back()->with('success', 'Bank Delete Successfully');
    }

    public function trashed()
    {
        $banks = Bank::onlyTrashed()->get();
        return view('admin.bank.index', compact('banks'));
    }

    public function restore($id)
    {
        Bank::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Bank Restore Successfully');
    }
}
