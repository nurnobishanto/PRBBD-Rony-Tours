<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\FileUpload;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    use FileUpload;

    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        if($request->has('image')){
            $input['image'] = $this->uploadFile($request->file('image'), 'slider');
        }

        try{
            Slider::create($input);
            return redirect()->back()->with('success', 'Slider Create Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $input = $request->validate([
            'title' => 'required|max:255|unique:sliders,title,'.$slider->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        if($request->has('image')){
            if($slider->image != null) $this->deleteFile($slider->image);
            $input['image'] = $this->uploadFile($request->file('image'), 'slider');
        }

        try{
            $slider->update($input);
            return redirect()->back()->with('success', 'Slider Update Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->back()->with('success', 'Slider Delete Successfully');
    }

    public function trashed()
    {
        $sliders = Slider::onlyTrashed()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function restore($id)
    {
        Slider::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Slider Restore Successfully');
    }
}
