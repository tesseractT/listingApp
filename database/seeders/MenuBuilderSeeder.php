<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array('id' => '1', 'name' => 'Main Menu', 'created_at' => NULL, 'updated_at' => '2024-03-30 17:09:06'),
            array('id' => '2', 'name' => 'Footer Menu One', 'created_at' => '2024-04-01 12:38:26', 'updated_at' => '2024-04-01 12:38:26'),
            array('id' => '3', 'name' => 'Footer Menu Two', 'created_at' => '2024-04-01 12:39:02', 'updated_at' => '2024-04-01 12:39:02'),
            array('id' => '4', 'name' => 'Footer Menu Three', 'created_at' => '2024-04-01 12:39:12', 'updated_at' => '2024-04-01 12:39:12')
        );
        $admin_menu_items = array(
            array('id' => '1', 'label' => 'Home', 'link' => '/', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '1', 'depth' => '0', 'created_at' => '2024-03-30 17:09:22', 'updated_at' => '2024-03-30 17:09:29'),
            array('id' => '2', 'label' => 'About Us', 'link' => '/about-us', 'parent_id' => '0', 'sort' => '3', 'class' => NULL, 'menu_id' => '1', 'depth' => '0', 'created_at' => '2024-03-30 17:13:06', 'updated_at' => '2024-04-01 12:13:03'),
            array('id' => '3', 'label' => 'Blogs', 'link' => '/blog', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '1', 'depth' => '0', 'created_at' => '2024-03-30 17:14:02', 'updated_at' => '2024-04-01 12:13:07'),
            array('id' => '4', 'label' => 'Listings', 'link' => '/listing', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '1', 'depth' => '0', 'created_at' => '2024-03-30 17:14:34', 'updated_at' => '2024-04-01 12:13:07'),
            array('id' => '5', 'label' => 'Contact Us', 'link' => '/contact-us', 'parent_id' => '8', 'sort' => '5', 'class' => NULL, 'menu_id' => '1', 'depth' => '1', 'created_at' => '2024-03-30 17:15:06', 'updated_at' => '2024-04-01 12:12:27'),
            array('id' => '6', 'label' => 'Privacy Policy', 'link' => '/privacy-policy', 'parent_id' => '8', 'sort' => '6', 'class' => NULL, 'menu_id' => '1', 'depth' => '1', 'created_at' => '2024-03-30 17:15:43', 'updated_at' => '2024-03-31 13:51:47'),
            array('id' => '7', 'label' => 'Terms and Conditions', 'link' => '/terms-and-conditions', 'parent_id' => '8', 'sort' => '7', 'class' => NULL, 'menu_id' => '1', 'depth' => '1', 'created_at' => '2024-03-30 22:13:52', 'updated_at' => '2024-03-31 22:30:19'),
            array('id' => '8', 'label' => 'Pages', 'link' => '#', 'parent_id' => '0', 'sort' => '4', 'class' => NULL, 'menu_id' => '1', 'depth' => '0', 'created_at' => '2024-03-31 13:51:40', 'updated_at' => '2024-04-01 12:12:24'),
            array('id' => '9', 'label' => 'Login', 'link' => '/login', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '2', 'depth' => '0', 'created_at' => '2024-04-01 12:39:51', 'updated_at' => '2024-04-01 12:40:14'),
            array('id' => '10', 'label' => 'Register', 'link' => '/register', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '2', 'depth' => '0', 'created_at' => '2024-04-01 12:40:14', 'updated_at' => '2024-04-01 12:41:35'),
            array('id' => '11', 'label' => 'Forgot Password', 'link' => '/forgot-password', 'parent_id' => '0', 'sort' => '3', 'class' => NULL, 'menu_id' => '2', 'depth' => '0', 'created_at' => '2024-04-01 12:41:35', 'updated_at' => '2024-04-01 12:41:35'),
            array('id' => '12', 'label' => 'Contact Us', 'link' => '/contact-us', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-04-01 14:12:20', 'updated_at' => '2024-04-01 14:12:27'),
            array('id' => '13', 'label' => 'Terms & Conditions', 'link' => '/terms-and-conditions', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-04-01 14:12:27', 'updated_at' => '2024-04-01 14:12:32'),
            array('id' => '14', 'label' => 'Privacy Policy', 'link' => '/privacy-policy', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-04-01 14:12:32', 'updated_at' => '2024-04-01 14:12:35'),
            array('id' => '15', 'label' => 'Blogs', 'link' => '/blog', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '4', 'depth' => '0', 'created_at' => '2024-04-01 14:13:01', 'updated_at' => '2024-04-01 14:13:20'),
            array('id' => '16', 'label' => 'Listings', 'link' => '/listing', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '4', 'depth' => '0', 'created_at' => '2024-04-01 14:13:08', 'updated_at' => '2024-04-01 14:13:23'),
            array('id' => '17', 'label' => 'Home', 'link' => '/', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '4', 'depth' => '0', 'created_at' => '2024-04-01 14:13:13', 'updated_at' => '2024-04-01 14:13:19')
        );

        \DB::table('admin_menus')->insert($admin_menus);
        \DB::table('admin_menu_items')->insert($admin_menu_items);
    }
}
