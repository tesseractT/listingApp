<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            array('id' => '1', 'name' => 'section index', 'guard_name' => 'web', 'group_name' => 'section', 'created_at' => '2024-04-02 13:20:50', 'updated_at' => '2024-04-02 13:20:50'),
            array('id' => '2', 'name' => 'section create', 'guard_name' => 'web', 'group_name' => 'section', 'created_at' => '2024-04-02 13:21:09', 'updated_at' => '2024-04-02 13:21:09'),
            array('id' => '3', 'name' => 'section update', 'guard_name' => 'web', 'group_name' => 'section', 'created_at' => '2024-04-02 13:21:21', 'updated_at' => '2024-04-02 13:21:21'),
            array('id' => '4', 'name' => 'section delete', 'guard_name' => 'web', 'group_name' => 'section', 'created_at' => '2024-04-02 13:21:30', 'updated_at' => '2024-04-02 13:21:30'),
            array('id' => '5', 'name' => 'listing index', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:38:18', 'updated_at' => '2024-04-02 13:38:18'),
            array('id' => '6', 'name' => 'listing create', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:38:30', 'updated_at' => '2024-04-02 13:38:30'),
            array('id' => '7', 'name' => 'listing update', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:38:42', 'updated_at' => '2024-04-02 13:38:42'),
            array('id' => '8', 'name' => 'listing delete', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:38:48', 'updated_at' => '2024-04-02 13:38:48'),
            array('id' => '9', 'name' => 'pending listing', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:40:00', 'updated_at' => '2024-04-02 13:40:00'),
            array('id' => '10', 'name' => 'listing review', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:40:20', 'updated_at' => '2024-04-02 13:40:20'),
            array('id' => '11', 'name' => 'listing claims', 'guard_name' => 'web', 'group_name' => 'listing', 'created_at' => '2024-04-02 13:40:30', 'updated_at' => '2024-04-02 13:40:30'),
            array('id' => '12', 'name' => 'package index', 'guard_name' => 'web', 'group_name' => 'package', 'created_at' => '2024-04-02 13:44:03', 'updated_at' => '2024-04-02 13:44:03'),
            array('id' => '13', 'name' => 'package create', 'guard_name' => 'web', 'group_name' => 'package', 'created_at' => '2024-04-02 13:44:13', 'updated_at' => '2024-04-02 13:44:13'),
            array('id' => '14', 'name' => 'package update', 'guard_name' => 'web', 'group_name' => 'package', 'created_at' => '2024-04-02 13:44:17', 'updated_at' => '2024-04-02 13:44:17'),
            array('id' => '15', 'name' => 'package delete', 'guard_name' => 'web', 'group_name' => 'package', 'created_at' => '2024-04-02 13:44:24', 'updated_at' => '2024-04-02 13:44:24'),
            array('id' => '16', 'name' => 'order index', 'guard_name' => 'web', 'group_name' => 'order', 'created_at' => '2024-04-02 13:46:05', 'updated_at' => '2024-04-02 13:46:05'),
            array('id' => '17', 'name' => 'order delete', 'guard_name' => 'web', 'group_name' => 'order', 'created_at' => '2024-04-02 13:46:12', 'updated_at' => '2024-04-02 13:46:12'),
            array('id' => '18', 'name' => 'message index', 'guard_name' => 'web', 'group_name' => 'message', 'created_at' => '2024-04-02 13:47:06', 'updated_at' => '2024-04-02 13:47:06'),
            array('id' => '19', 'name' => 'testimonial index', 'guard_name' => 'web', 'group_name' => 'testimonial', 'created_at' => '2024-04-02 13:47:37', 'updated_at' => '2024-04-02 13:47:37'),
            array('id' => '20', 'name' => 'testimonial create', 'guard_name' => 'web', 'group_name' => 'testimonial', 'created_at' => '2024-04-02 13:47:42', 'updated_at' => '2024-04-02 13:47:42'),
            array('id' => '21', 'name' => 'testimonial update', 'guard_name' => 'web', 'group_name' => 'testimonial', 'created_at' => '2024-04-02 13:47:49', 'updated_at' => '2024-04-02 13:47:49'),
            array('id' => '22', 'name' => 'testimonial delete', 'guard_name' => 'web', 'group_name' => 'testimonial', 'created_at' => '2024-04-02 13:47:54', 'updated_at' => '2024-04-02 13:47:54'),
            array('id' => '23', 'name' => 'blog index', 'guard_name' => 'web', 'group_name' => 'blog', 'created_at' => '2024-04-02 13:49:50', 'updated_at' => '2024-04-02 13:49:50'),
            array('id' => '24', 'name' => 'blog create', 'guard_name' => 'web', 'group_name' => 'blog', 'created_at' => '2024-04-02 13:49:57', 'updated_at' => '2024-04-02 13:49:57'),
            array('id' => '25', 'name' => 'blog update', 'guard_name' => 'web', 'group_name' => 'blog', 'created_at' => '2024-04-02 13:50:02', 'updated_at' => '2024-04-02 13:50:02'),
            array('id' => '26', 'name' => 'blog delete', 'guard_name' => 'web', 'group_name' => 'blog', 'created_at' => '2024-04-02 13:50:08', 'updated_at' => '2024-04-02 13:50:08'),
            array('id' => '27', 'name' => 'blog comment', 'guard_name' => 'web', 'group_name' => 'blog', 'created_at' => '2024-04-02 13:50:17', 'updated_at' => '2024-04-02 13:50:17'),
            array('id' => '28', 'name' => 'about index', 'guard_name' => 'web', 'group_name' => 'pages', 'created_at' => '2024-04-02 13:52:21', 'updated_at' => '2024-04-02 13:52:21'),
            array('id' => '29', 'name' => 'contact index', 'guard_name' => 'web', 'group_name' => 'pages', 'created_at' => '2024-04-02 13:52:29', 'updated_at' => '2024-04-02 13:52:29'),
            array('id' => '30', 'name' => 'privacy policy index', 'guard_name' => 'web', 'group_name' => 'pages', 'created_at' => '2024-04-02 13:52:59', 'updated_at' => '2024-04-02 13:52:59'),
            array('id' => '31', 'name' => 'terms and conditions index', 'guard_name' => 'web', 'group_name' => 'pages', 'created_at' => '2024-04-02 13:53:29', 'updated_at' => '2024-04-02 13:53:29'),
            array('id' => '32', 'name' => 'footer index', 'guard_name' => 'web', 'group_name' => 'footer', 'created_at' => '2024-04-02 13:54:35', 'updated_at' => '2024-04-02 13:54:35'),
            array('id' => '33', 'name' => 'social index', 'guard_name' => 'web', 'group_name' => 'footer', 'created_at' => '2024-04-02 13:54:54', 'updated_at' => '2024-04-02 13:54:54'),
            array('id' => '34', 'name' => 'access management index', 'guard_name' => 'web', 'group_name' => 'access management', 'created_at' => '2024-04-02 13:56:02', 'updated_at' => '2024-04-02 13:56:02'),
            array('id' => '35', 'name' => 'menu builder index', 'guard_name' => 'web', 'group_name' => 'menu builder', 'created_at' => '2024-04-02 13:56:54', 'updated_at' => '2024-04-02 13:56:54'),
            array('id' => '36', 'name' => 'settings index', 'guard_name' => 'web', 'group_name' => 'settings', 'created_at' => '2024-04-02 13:57:29', 'updated_at' => '2024-04-02 13:57:29'),
            array('id' => '37', 'name' => 'payment settings index', 'guard_name' => 'web', 'group_name' => 'settings', 'created_at' => '2024-04-02 17:49:11', 'updated_at' => '2024-04-02 17:49:11')
        );
        $roles = array(
            array('id' => '2', 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => '2024-04-02 16:27:54', 'updated_at' => '2024-04-02 16:27:54'),
            array('id' => '3', 'name' => 'Writer', 'guard_name' => 'web', 'created_at' => '2024-04-02 16:51:00', 'updated_at' => '2024-04-02 16:51:00')
        );
        $role_has_permissions = array(
            array('permission_id' => '23', 'role_id' => '3'),
            array('permission_id' => '24', 'role_id' => '3'),
            array('permission_id' => '25', 'role_id' => '3'),
            array('permission_id' => '26', 'role_id' => '3'),
            array('permission_id' => '27', 'role_id' => '3')
        );
        $model_has_roles = array(
            array('role_id' => '2', 'model_type' => 'App\\Models\\User', 'model_id' => '1'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '7'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '8')
        );

        \DB::table('permissions')->insert($permissions);
        \DB::table('roles')->insert($roles);
        \DB::table('role_has_permissions')->insert($role_has_permissions);
        \DB::table('model_has_roles')->insert($model_has_roles);
    }
}
