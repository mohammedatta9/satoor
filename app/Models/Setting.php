<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'store_settings'; // تحديد اسم الجدول

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
