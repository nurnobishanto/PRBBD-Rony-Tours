<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|unique:pages|max:255',
            'slug' => 'required|unique:pages|max:255',
            'body' => 'required',
            'url' => 'nullable|string',
        ]);

        try{

            Page::create($input);
            return redirect()->back()->with('success', 'Page Create Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $input = $request->validate([
            'name' => 'required|max:255|unique:pages,name,'.$page->id,
            'slug' => 'required|max:255|unique:pages,slug'.$page->id,
            'body' => 'required',
            'url' => 'nullable|string',
        ]);

        try{

            $page->update($input);
            return redirect()->back()->with('success', 'Page Update Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->with('success', 'Page Delete Successfully');
    }

    public function trashed()
    {
        $page = Page::onlyTrashed()->get();
        return view('admin.pages.index', compact('page'));
    }

    public function restore($id)
    {
        Page::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Page Restore Successfully');
    }
}
