<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create([
            'name' => 'Admin',
        ]);
        $role2 = Role::create([
            'name' => 'Employee',
        ]);

        Permission::create(['name' => 'Category_index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Category_create'])->assignRole($role1);
        Permission::create(['name' => 'Category_edit'])->assignRole($role1);


        Permission::create(['name' => 'Product_index'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'Product_create'])->assignRole($role1);
        Permission::create(['name' => 'Product_edit'])->assignRole($role1);

        Permission::create(['name' => 'Arqueos_index'])->assignRole($role1);
        Permission::create(['name' => 'Reportes_index'])->assignRole($role1);
        Permission::create(['name' => 'Ventas_index'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'Roles_index'])->assignRole($role1);
        Permission::create(['name' => 'Permisos_index'])->assignRole($role1);
        Permission::create(['name' => 'Asignar_index'])->assignRole($role1);
        Permission::create(['name' => 'Usuarios_index'])->assignRole($role1);






    }
}
