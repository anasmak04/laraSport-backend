<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'title' => 'category_access',
            ],
            [
                'title' => 'category_edit',
            ],
            [
                'title' => 'category_delete',
            ],
            [
                'title' => 'category_create',
            ],
        ];
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
