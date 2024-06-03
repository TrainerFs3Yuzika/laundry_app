<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [ 'super-admin'];
        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        $user = User::create([
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('super-admin');

        $permissions = ["dashboard", "user", "role", "product", "categories", "transaction", ];
        foreach($permissions as $permission){
            $per = Permission::create(['name' => $permission]);
            $role = Role::where('name', 'super-admin')->first();
            $role->givePermissionTo($per);
        }
    }
    }

