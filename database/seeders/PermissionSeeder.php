<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // \DB::table('roles')->truncate();
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \DB::table('permissions')->truncate();
        
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',
            'tag-list',
            'tag-create',
            'tag-edit',
            'tag-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
         ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}