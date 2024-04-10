<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'comentario-list',
            'comentario-create',
            'comentario-edit',
            'comentario-all',
            'comentario-delete',
            'recetas-list',
            'recetas-create',
            'recetas-edit',
            'recetas-all',
            'recetas-delete',
            'ingredientes-list',
            'ingredientes-create',
            'ingredientes-edit',
            'ingredientes-all',
            'ingredientes-delete'
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
