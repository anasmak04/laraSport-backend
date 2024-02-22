<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin_permissions =  [1,2];
        $user_permissions =  [3,4];

        Role::where('name','Admin')->firstOrFail()->permissions()->sync($admin_permissions);
        Role::where('name','User')->firstOrFail()->permissions()->sync($user_permissions);
    }
}
