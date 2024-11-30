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
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id(); // المفتاح الرئيسي
            $table->unsignedBigInteger('user_id')->length(10)->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('currency_id')->length(10)->nullable()->references('id')->on('currencies');
            $table->string('store_name')->nullable(); // اسم المتجر
            $table->string('store_name_en')->nullable(); // en اسم المتجر
            $table->string('store_email')->nullable(); // البريد الإلكتروني للمتجر
            $table->string('store_phone')->nullable(); // رقم هاتف المتجر
            $table->string('currency_short')->nullable(); // العملة اختصار(مثل USD، SAR)
            $table->string('store_logo')->nullable(); // شعار المتجر
            $table->string('footer_logo')->nullable(); // شعار المتجر
            $table->string('store_address')->nullable(); // عنوان المتجر
            $table->boolean('maintenance_mode')->default(false); // وضع الصيانة
            $table->string('timezone')->default('UTC'); // المنطقة الزمنية

            // روابط التواصل الاجتماعي
            $table->string('facebook_url')->nullable(); // رابط فيسبوك
            $table->string('twitter_url')->nullable(); // رابط تويتر
            $table->string('instagram_url')->nullable(); // رابط إنستغرام
            $table->string('linkedin_url')->nullable(); // رابط لينكدإن
            $table->string('youtube_url')->nullable(); // رابط يوتيوب

            // من نحن
            $table->longtext('about_us_en')->nullable(); // من نحن (إنجليزي)
            $table->longtext('about_us_ar')->nullable(); // من نحن (عربي)

            // سياسة الخصوصية
            $table->longtext('privacy_policy_en')->nullable(); // سياسة الخصوصية (إنجليزي)
            $table->longtext('privacy_policy_ar')->nullable(); // سياسة الخصوصية (عربي)

            // الشحن والاستلام
            $table->longtext('shipping_info_en')->nullable(); // معلومات الشحن (إنجليزي)
            $table->longtext('shipping_info_ar')->nullable(); // معلومات الشحن (عربي)

            // الشروط والأحكام
            $table->longtext('terms_conditions_en')->nullable(); // الشروط والأحكام (إنجليزي)
            $table->longtext('terms_conditions_ar')->nullable(); // الشروط والأحكام (عربي)

            $table->timestamps(); // توقيت الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_settings');
    }
};
