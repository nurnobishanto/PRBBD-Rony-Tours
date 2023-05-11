<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::get();
        return view('admin.passenger.index', compact('passengers'));
    }

    public function create()
    {
        $users = User::get();
        return view('admin.passenger.create', compact('users'));
    }

    public function store(Request $request)
    {
        // return $request;
        $input = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:passengers,email',
            'phone' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|numeric|in:1,2,3',
        ]);

        try{
            Passenger::create($input);
            return redirect()->back()->with('success', 'Passenger Create Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Passenger $passenger)
    {
        $users = User::get();
        return view('admin.passenger.edit',compact('passenger', 'users'));
    }

    public function update(Request $request, Passenger $passenger)
    {
        $input = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:passengers,email,'.$passenger->id,
            'phone' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|numeric|in:1,2,3',
        ]);

        try{
            $passenger->update($input);
            return redirect()->back()->with('success', 'Passenger Update Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();
        return redirect()->back()->with('success', 'Passenger Update Successfully');
    }

    public function trashed()
    {
        $passengers = Passenger::onlyTrashed()->get();
        return view('admin.passenger.index', compact('passengers'));
    }

    public function restore($id)
    {
        Passenger::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Passenger Restore Successfully');
    }
}
