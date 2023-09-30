<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Administrator;
use App\Models\Status;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create();

        Administrator::create([
            'user_id' => $user->id,
            'country_id' => 1
        ]);

        $permissions = Config::get('permissions.administrator-permissions', []);
        $user->syncPermissions($permissions);

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }
    }
}
