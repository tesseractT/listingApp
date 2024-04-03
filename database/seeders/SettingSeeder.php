<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = array(
            array('id' => '1', 'key' => 'site_name', 'value' => 'Home Gurus', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 20:11:33'),
            array('id' => '2', 'key' => 'site_email', 'value' => 'support@homegurus.com', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 08:05:01'),
            array('id' => '3', 'key' => 'site_phone', 'value' => '+786337882', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 08:05:01'),
            array('id' => '4', 'key' => 'site_default_currency', 'value' => 'USD', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 08:05:01'),
            array('id' => '5', 'key' => 'site_currency_icon', 'value' => '$', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 08:05:01'),
            array('id' => '6', 'key' => 'site_currency_position', 'value' => 'left', 'created_at' => '2024-03-15 08:01:34', 'updated_at' => '2024-03-15 23:53:21'),
            array('id' => '7', 'key' => 'site_timezone', 'value' => 'Europe/London', 'created_at' => '2024-03-18 20:56:07', 'updated_at' => '2024-03-18 20:56:07'),
            array('id' => '8', 'key' => 'pusher_app_id', 'value' => '1777112', 'created_at' => '2024-03-20 23:05:41', 'updated_at' => '2024-03-25 17:23:50'),
            array('id' => '9', 'key' => 'pusher_app_key', 'value' => '47b806889117968095a5', 'created_at' => '2024-03-20 23:05:41', 'updated_at' => '2024-03-25 17:23:50'),
            array('id' => '10', 'key' => 'pusher_secret_key', 'value' => '84a4f5e120a2d5cd9727', 'created_at' => '2024-03-20 23:05:41', 'updated_at' => '2024-03-25 17:23:50'),
            array('id' => '11', 'key' => 'pusher_cluster', 'value' => 'mt1', 'created_at' => '2024-03-20 23:05:41', 'updated_at' => '2024-03-25 17:23:50'),
            array('id' => '12', 'key' => 'logo', 'value' => '/uploads/media_660c917271ce5.jpg', 'created_at' => '2024-04-02 23:14:58', 'updated_at' => '2024-04-02 23:14:58'),
            array('id' => '13', 'key' => 'favicon', 'value' => '/uploads/media_660c917271df5.png', 'created_at' => '2024-04-02 23:14:58', 'updated_at' => '2024-04-02 23:14:58'),
            array('id' => '14', 'key' => 'default_site_color', 'value' => '#6c5551', 'created_at' => '2024-04-03 00:43:19', 'updated_at' => '2024-04-03 00:43:19')
        );

        \DB::table('settings')->insert($settings);
    }
}
