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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->length(10)->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('name_en');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('tags')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('status')->length(3)->default(1);  // عمود الحالة (1/0) افتراضيًا مفعل
            $table->integer('popular_item')->length(3)->default(0);  // عمود (1/0) افتراضيًا غير مفعل
            $table->integer('trending_item')->length(3)->default(0);  // عمود (1/0) افتراضيًا غير مفعل
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
        Schema::dropIfExists('products');
    }
};
