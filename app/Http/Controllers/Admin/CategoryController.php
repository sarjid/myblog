<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','ASC')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'sometimes|max:255',
            'images' => 'image|mimes:jpg,jpeg,gif,png',
        ]);

        if ($request->has('image')) {
           $image = $request->image;
           $imgName = Str::slug($request->input('name'),'-').uniqid().'.'.$image->getClientOriginalExtension();

           //create directory
           if (!Storage::disk('public')->exists('category')) {
               Storage::disk('public')->makeDirectory('category');
           }

           $image->storeAs('category',$imgName,'public');
        }


        $data = $request->all();
        $data['slug'] = Str::slug($request->input('name'));
        $data['image'] = $imgName;
        Category::create($data);
        Toastr::success('Category Added Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'sometimes|max:255',
        ]);
        $cat = Category::find($id);
        if ($request->has('image')) {
            $image = $request->image;
            $imgName = Str::slug($request->input('name'),'-').uniqid().'.'.$image->getClientOriginalExtension();
            //create directory
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
             //delete old image
             if (Storage::disk('public')->exists('category/'.$cat->image)) {
                Storage::disk('public')->delete('category/'.$cat->image);
            }
            $image->storeAs('category',$imgName,'public');
         }

        $data = $request->all();
        $data['slug'] = Str::slug($request->input('name'));
        $data['image'] = $imgName;
        $cat->update($data);
        Toastr::success('Category Update Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (Storage::disk('public')->exists('category/'.$category->image)) {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        if ($category) {
           $category->delete();
        }
        Toastr::success('Delete Success');
        return redirect()->back();
    }
}
