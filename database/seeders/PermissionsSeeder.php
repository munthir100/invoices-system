<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsConfig = Config::get('permissions');

        foreach ($permissionsConfig as $permissionGroup) {
            foreach ($permissionGroup as $permissionName) {
                // Create a new permission if it doesn't exist.
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }
    }
}
