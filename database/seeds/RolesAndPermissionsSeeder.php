<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'data-informasi']);
        Role::create(['name' => 'bidang-mutasi']);
        Role::create(['name' => 'pegawai']);

        $user = User::find(1);
        $user->assignRole('administrator');
    }
}
