<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionsRoleTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $role = Role::where('name', 'super')->firstOrFail();
        $role->perms()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
