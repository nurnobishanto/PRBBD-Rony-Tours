<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportDepartment;
use Illuminate\Http\Request;

class SupportDepartmentController extends Controller
{

    public function index()
    {

        $departments = SupportDepartment::all();
        return view('admin.departments.index',compact('departments'));

    }


    public function create()
    {

        return view('admin.departments.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:support_departments',
        ]);

        SupportDepartment::create([
            'name'=>$request->name,
        ]);

        toastr()->success('Support Department Created Successfully!','Support Department Created!');
        return redirect()->route('admin.departments.create')->with('refresh', 'true');
    }

    public function edit(string $id)
    {

        $department = SupportDepartment::find($id);
        return view('admin.departments.edit',compact('department'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|unique:support_departments',
        ]);
        $department = SupportDepartment::find($id);
        $department->name = $request->name;
        $department->update();
        toastr()->success('Support Department Updated Successfully!','Support Department Updated!');
        return redirect()->route('admin.departments.index');
    }

    public function destroy(string $id)
    {
        SupportDepartment::find($id)->delete();
        toastr()->success('Support Department Deleted Successfully!','SupportDepartment Deleted!');
        return redirect()->route('admin.departments.index');
    }
}

