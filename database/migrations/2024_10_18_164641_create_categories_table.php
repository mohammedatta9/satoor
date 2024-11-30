<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->length(10)->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('name');  // عمود اسم الفئة باللغة العربية أو الافتراضية
            $table->string('name_en');  // عمود اسم الفئة باللغة الإنجليزية
            $table->string('slug')->unique();  // عمود الـ slug الفريد
            $table->string('icon')->nullable();  // عمود الأيقونة (رمز الفئة، يمكن أن يكون اختياري)
            $table->integer('status')->length(3)->default(1);  // عمود الحالة (1/0) افتراضيًا مفعل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
