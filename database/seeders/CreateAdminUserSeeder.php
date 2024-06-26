<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12345678')
        ]);

        $user2 = User::create([
            'name' => 'Manolo',
            'email' => 'Manolo1990@demo.com',
            'password' => bcrypt('12345678')
        ]);

        $user3 = User::create([
            'name' => 'Paula',
            'email' => 'Paula2000@demo.com',
            'password' => bcrypt('12345678')
        ]);

        $user4 = User::create([
            'name' => 'Marc',
            'email' => 'Marc2006@demo.com',
            'password' => bcrypt('12345678')
        ]);

        $user5 = User::create([
            'name' => 'Nerea',
            'email' => 'Nerea2003@demo.com',
            'password' => bcrypt('12345678')
        ]);

        $user6 = User::create([
            'name' => 'Rodrigo',
            'email' => 'Rodri1999@demo.com',
            'password' => bcrypt('12345678')
        ]);


        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $permissions = [
            'comentario-list',
            'comentario-create',
            'comentario-edit',
            'comentario-delete',
            'recetas-create',
            'recetas-edit',
            'recetas-all',
            'recetas-delete'
        ];
        $role2->syncPermissions($permissions);
        Category::create(['name' => 'Vue.js']);
        Category::create(['name' => 'Cat 2']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $user2->assignRole([$role2->id]);
        $user3->assignRole([$role2->id]);
        $user4->assignRole([$role2->id]);
        $user5->assignRole([$role2->id]);
        $user6->assignRole([$role2->id]);
    }
}
