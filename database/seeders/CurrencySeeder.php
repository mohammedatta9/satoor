<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            ['symbol' => '$', 'iso_code' => 'USD', 'name' => 'US Dollar'],
            ['symbol' => '€', 'iso_code' => 'EUR', 'name' => 'Euro'],
            ['symbol' => '¥', 'iso_code' => 'JPY', 'name' => 'Japanese Yen'],
            ['symbol' => '£', 'iso_code' => 'GBP', 'name' => 'British Pound'],
            ['symbol' => '₣', 'iso_code' => 'CHF', 'name' => 'Swiss Franc'],
            ['symbol' => 'C$', 'iso_code' => 'CAD', 'name' => 'Canadian Dollar'],
            ['symbol' => 'A$', 'iso_code' => 'AUD', 'name' => 'Australian Dollar'],
            ['symbol' => '₩', 'iso_code' => 'KRW', 'name' => 'South Korean Won'],
            ['symbol' => '₽', 'iso_code' => 'RUB', 'name' => 'Russian Ruble'],
            ['symbol' => '₹', 'iso_code' => 'INR', 'name' => 'Indian Rupee'],
            ['symbol' => 'R$', 'iso_code' => 'BRL', 'name' => 'Brazilian Real'],
            ['symbol' => '₫', 'iso_code' => 'VND', 'name' => 'Vietnamese Dong'],
            ['symbol' => '₺', 'iso_code' => 'TRY', 'name' => 'Turkish Lira'],
            ['symbol' => '₪', 'iso_code' => 'ILS', 'name' => 'Israeli New Shekel'],
            ['symbol' => 'د.إ', 'iso_code' => 'AED', 'name' => 'UAE Dirham'],
            ['symbol' => '₦', 'iso_code' => 'NGN', 'name' => 'Nigerian Naira'],
            ['symbol' => 'P', 'iso_code' => 'BWP', 'name' => 'Botswana Pula'],
            ['symbol' => 'R', 'iso_code' => 'ZAR', 'name' => 'South African Rand'],
            ['symbol' => 'HK$', 'iso_code' => 'HKD', 'name' => 'Hong Kong Dollar'],
            ['symbol' => 'S$', 'iso_code' => 'SGD', 'name' => 'Singapore Dollar'],
            ['symbol' => 'NZ$', 'iso_code' => 'NZD', 'name' => 'New Zealand Dollar'],
            ['symbol' => 'MX$', 'iso_code' => 'MXN', 'name' => 'Mexican Peso'],
        ]);
    }
}
