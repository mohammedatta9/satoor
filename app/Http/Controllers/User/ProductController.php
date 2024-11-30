<?php

namespace App\Http\Controllers\User;

use File;
use Image;
use App\Models\User;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Product_size;
use Illuminate\Http\Request;
use App\Models\Product_color;
use App\Models\Product_image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    public function index(Request $request){

       $products = Auth::user()->products()->orderBy('id','desc')->get();
       return view('user.product.index', compact('products'));
    }


    public function create(Request $request){

        $categories = Auth::user()->categories()->latest()->get();
        return view('user.product.create_product', compact('categories'));
    }

    public function store(Request $request){

        $rules = [
            'name'=>'required',
            'name_en'=>'required|unique:products',
            'category'=>'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'description_en'=>'required',
            'icon'=>'required|mimes:png,jpg,jpeg',
        ];

        $customMessages = [
            'icon.required' => trans('admin_validation.Product icon is required'),
            'icon.mimes' => trans('admin_validation.just png,jpg,jpeg'),
            'category.required' => trans('admin_validation.Category is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name_en.required' => trans('admin_validation.Name_en is required'),
            'name_en.unique' => trans('admin_validation.name_en already exist'),
             'price.required' => trans('admin_validation. price is required'),
            'price.numeric' => trans('admin_validation. price should be numeric value'),
            'description.required' => trans('admin_validation.Description is required'),
            'description_en.required' => trans('admin_validation.Description is required'),
         ];
        $this->validate($request, $rules,$customMessages);


        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            $image = $request->file('icon')->store('/','files');
        }

        $product = new Product();

        $product->user_id = Auth::user()->id;
        $product->image = $image;
        $product->name = $request->name;
        $product->name_en = $request->name_en;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale;
        $product->slug = Str::slug($request->name_en);
        $product->description = $request->description;
        $product->description_en = $request->description_en;
        $product->tags = $request->tags;
        $product->status = $request->status ? 1 : 0;
        $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $product->popular_item = $request->popular_item ? 1 : 0;
        $product->trending_item = $request->trending_item ? 1 : 0;
        $product->save();

        $categories = $request->category;
        $product->categories()->attach($categories);

        if($request->hasFile('photos'))
            {
             $product_images = $request->file('photos');
             foreach($product_images as $value){
                    $image = $value->store('/','files');
                    Product_image::create([
                        'image' => $image,
                        'product_id' => $product->id,
                    ]);
                }
            }

            if($request->have_color == '1')
            {
             $product_colors = $request->color;
             foreach($product_colors as $value){
                    Product_color::create([
                        'color' => $value,
                        'product_id' => $product->id,
                    ]);
                }
            }
            if($request->size)
            {
             $product_sizes = $request->size;
             foreach($product_sizes as $value){
                    Product_size::create([
                        'size' => $value,
                        'product_id' => $product->id,
                    ]);
                }
            }
        $notification = trans('admin_validation.Created successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function edit($id){

        $product = Product::find($id);
        if($product->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }
        $categories = Category::get();

        return view('user.product.edit_product', compact('categories','product'));
    }

    public function update(Request $request, $id){

        $rules = [
            'name'=>'required',
            'name_en'=>'required|unique:products,name_en,'.$id,
            'category'=>'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'description_en'=>'required',
            'icon'=>'mimes:png,jpg,jpeg',
        ];
        $customMessages = [
            'icon.required' => trans('admin_validation.Product icon is required'),
            'icon.mimes' => trans('admin_validation.just png,jpg,jpeg'),
            'category.required' => trans('admin_validation.Category is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name_en.required' => trans('admin_validation.Name_en is required'),
            'name_en.unique' => trans('admin_validation.name_en already exist'),
             'price.required' => trans('admin_validation. price is required'),
            'price.numeric' => trans('admin_validation. price should be numeric value'),
            'description.required' => trans('admin_validation.Description is required'),
            'description_en.required' => trans('admin_validation.Description is required'),
         ];
        $this->validate($request, $rules,$customMessages);

        $product = Product::find($id);
        if($product->user_id != Auth::user()->id){
            $notification = trans('dash.you dont have permission to access this resource');
            $notification = array('messege'=>$notification,'alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }

        $image = $product->image;
        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            if($product->image)
               Storage::disk('files')->delete($product->image);
            $image = $request->file('icon')->store('/','files');
        }

        $product->image = $image;
        $product->name = $request->name;
        $product->name_en = $request->name_en;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale;
        $product->slug = Str::slug($request->name_en);
        $product->description = $request->description;
        $product->description_en = $request->description_en;
        $product->tags = $request->tags;
        $product->status = $request->status ? 1 : 0;
        $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $product->popular_item = $request->popular_item ? 1 : 0 ;
        $product->trending_item = $request->trending_item ? 1 : 0 ;
        $product->save();

        $categories = $request->category;
        $product->categories()->sync($categories);

        if($request->hasFile('photos'))
            {
             $product_images = $request->file('photos');
             foreach($product_images as $value){
                    $image = $value->store('/','files');
                    Product_image::create([
                        'image' => $image,
                        'product_id' => $product->id,
                    ]);
                }
            }
        $product->sizes()->delete();
        if($request->size)
        {
         $product_sizes = $request->size;
         foreach($product_sizes as $value){
                Product_size::create([
                    'size' => $value,
                    'product_id' => $product->id,
                ]);
            }
        }

        $product->colors()->delete();
        if($request->have_color == '1')
        {
         $product_colors = $request->color;
         foreach($product_colors as $value){
            if($value != '#e3e3e3')
                Product_color::create([
                    'color' => $value,
                    'product_id' => $product->id,
                ]);
            }
        }

        $notification = trans('admin_validation.Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.product.index')->with($notification);

    }

    public function productImage_delete($id){
        $image = Product_image::find($id)->delete();

    }

    public function destroy($id){

        $product = Product::findOrFail($id);
        if($product->image){
            Storage::disk('files_admin')->delete($product->image);
        }

        if($product->product_icon){
            $old_icon = $product->product_icon;

            if($old_icon){
                if(File::exists(public_path().'/'.$old_icon))unlink(public_path().'/'.$old_icon);
            }
        }

        if($product->download_file){
            $old_download_file = $product->download_file;
            if($old_download_file){
                if(File::exists(public_path().'/uploads/custom-images/'.$old_download_file))unlink(public_path().'/uploads/custom-images/'.$old_download_file);
            }
        }

        if($product->product_type!='script'){
            $variants = ProductVariant::where('product_id', $id)->get();
            foreach($variants as $variant){
                $old_download_file = $variant->file_name;
                $variant->delete();
                if($old_download_file){
                    if(File::exists(public_path().'/uploads/custom-images/'.$old_download_file)){
                        unlink(public_path().'/uploads/custom-images/'.$old_download_file);
                    }
                }
            }
        }

        ProductComment::where('product_id', $id)->delete();
        Review::where('product_id', $id)->delete();

        $product->delete();

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
