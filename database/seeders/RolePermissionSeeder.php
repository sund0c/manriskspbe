<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'add-kategorikontrol']);
        Permission::create(['name'=>'edit-kategorikontrol']);
        Permission::create(['name'=>'del-kategorikontrol']);
        Permission::create(['name'=>'view-kategorikontrol']);
        Permission::create(['name'=>'add-kontrol']);
        Permission::create(['name'=>'edit-kontrol']);
        Permission::create(['name'=>'del-kontrol']);
        Permission::create(['name'=>'view-kontrol']);
        Permission::create(['name'=>'add-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'del-user']);
        Permission::create(['name'=>'view-user']);
        Permission::create(['name'=>'add-riskregister']);
        Permission::create(['name'=>'edit-riskregister']);
        Permission::create(['name'=>'del-riskregister']);
        Permission::create(['name'=>'view-riskregister']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'persandian']);
        Role::create(['name'=>'opd']);

        $roleAdmin = Role::findByName('admin');
        $roleOpd = Role::findByName('opd');
        $rolePersandian = Role::findByName('persandian');

        $roleAdmin->givePermissionTo('add-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('del-user');
        $roleAdmin->givePermissionTo('view-user');
        $roleAdmin->givePermissionTo('add-kategorikontrol');
        $roleAdmin->givePermissionTo('edit-kategorikontrol');
        $roleAdmin->givePermissionTo('del-kategorikontrol');
        $roleAdmin->givePermissionTo('view-kategorikontrol');
        $roleAdmin->givePermissionTo('add-kontrol');
        $roleAdmin->givePermissionTo('edit-kontrol');
        $roleAdmin->givePermissionTo('del-kontrol');
        $roleAdmin->givePermissionTo('view-kontrol');

        $rolePersandian->givePermissionTo('add-riskregister');
        $rolePersandian->givePermissionTo('edit-riskregister');
        $rolePersandian->givePermissionTo('del-riskregister');

        $roleOpd->givePermissionTo('view-riskregister');
    }
}
