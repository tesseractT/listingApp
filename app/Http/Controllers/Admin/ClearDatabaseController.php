<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    function index(): View
    {
        return view('admin.clear-database.index');
    }

    function clear()
    {
        //Wipe Dtatbase
        Artisan::call('migrate:fresh');

        //Delete Files
        $this->deleteFiles();

        //Seed Database
        Artisan::call('db:seed', [
            '--class' => 'UserSeeder'
        ]);
        Artisan::call('db:seed', [
            '--class' => 'SettingSeeder'
        ]);
        Artisan::call('db:seed', [
            '--class' => 'PaymentSettingSeeder'
        ]);
        Artisan::call('db:seed', [
            '--class' => 'MenuBuilderSeeder'
        ]);
        Artisan::call('db:seed', [
            '--class' => 'RolePermissionSeeder'
        ]);

        return response(['status' => 'success', 'message' => 'Database Cleared Successfully']);
    }

    function deleteFiles()
    {
        $path = public_path('uploads');

        $allFiles = \File::allFiles($path);

        foreach ($allFiles as $file) {
            \File::delete($file->getPathname());
        }
    }
}
