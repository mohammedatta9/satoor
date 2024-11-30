<?php

namespace App\Http\Controllers\User;

use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories()->latest()->get();
        return view('user.category.category',compact('categories' ));
    }


    public function create()
    {
        $categories = Auth::user()->categories()->main()->orderBy('name','asc')->get();

        return view('user.category.create_category', compact('categories'));
    }


    public function store(Request $request)
    {


        $rules = [
            'name'=>'required|unique:categories',
            'name_en'=>'required|unique:categories',
            'status'=>'required',
            'category_id'=>'required',
            'icon'=>'required |mimes:png,jpg,jpeg',

        ];
        $customMessages = [
            'name.required' => trans('dash.Name is required'),
            'name_en.required' => trans('dash.Name_en is required'),
            'name.unique' => trans('dash.Name already exist'),
            'name_en.unique' => trans('dash.Name_en already exist'),
            'icon.required' => trans('dash.Icon is required'),
            'status.required' => trans('dash.status is required'),
            'mimes' => trans('dash.png,jpg,jpeg'),
        ];
        $this->validate($request, $rules,$customMessages);

        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            $icon = $request->file('icon')->store('/','files');
        }

        $category = new Category();

        $category->user_id = Auth::user()->id;
        $category->icon = $icon;
        $category->name = $request->name;
        $category->name_en = $request->name_en;
        $category->slug = $request->name_en;
        $category->status = $request->status;
        $category->category_id = $request->category_id;
        $category->save();

        $notification = trans('dash.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.category.index')->with($notification);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category->user_id == Auth::user()->id){
            $categories = Auth::user()->categories()->main()->orderBy('name','asc')->get();
            return view('user.category.edit_category',compact('category','categories'));
        }
        $notification = trans('dash.you dont have permission to access this resource');
        $notification = array('messege'=>$notification,'alert-type'=>'warning');
        return redirect()->back()->with($notification);
    }


    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        if($category->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }

        $rules = [
            'name'=>'required|unique:categories,name,'.$category->id,
            'name_en'=>'required|unique:categories,name_en,'.$category->id,
            'category_id'=>'required',
            'icon'=>'mimes:png,jpg,jpeg',

        ];

        $customMessages = [
            'name.required' => trans('dash.Name is required'),
            'name.unique' => trans('dash.Name already exist'),
            'name_en.required' => trans('dash.name_en is required'),
            'name_en.unique' => trans('dash.name_en already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $icon = $category->icon;
        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            if($category->icon)
               Storage::disk('files')->delete($category->icon);
            $icon = $request->file('icon')->store('/','files');
        }
        $category->icon = $icon;
        $category->name = $request->name;
        $category->name_en = $request->name_en;
        $category->slug = $request->name_en;
        $category->status = $request->status;
        $category->category_id = $request->category_id;
        $category->save();

        $notification = trans('dash.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.category.index')->with($notification);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }

        if(isset($category->icon))
        Storage::disk('files')->delete($category->icon);

        $category->delete();

        $notification = trans('dash.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = Category::find($id);
        if($category->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message = trans('dash.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('dash.Active Successfully');
        }
        return response()->json($message);
    }
}
