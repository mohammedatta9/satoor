<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends= ['image_url'];

    protected $hidden = [ 'created_at','updated_at'];

    public function getImageUrlAttribute(){
        if(!$this->image){
            return asset('storage/files_admin/default.png');
        }
        return asset('storage/files/'.$this->image);

    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function colors()
    {
        return $this->hasMany(Product_color::class);
    }
    public function sizes()
    {
        return $this->hasMany(Product_size::class);
    }
    public function images()
    {
        return $this->hasMany(Product_image::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterProducts(Builder $query, $status = 1 , $name = null, $tags = [], $categoryId = null)
    {
        return $query
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($tags, function ($query, $tags) {
                $query->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('name', $tags);
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            });
    }
}
