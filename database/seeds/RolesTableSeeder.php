<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrNew(['name'=>'super']);
        if(!$role->exists)
            DB::table('roles')->insert([
                'name' => 'super',
                'display_name' => 'Guardian',
                'school_id'=>'null'
            ]);

    }
}
