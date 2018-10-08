<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
class RoleUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','super@admin.com')->first();
        $role = \App\Role::where('name','super')->first();
                DB::table('role_user')->insert([
                    'user_id'=>$user->id,
                    'role_id'=>$role->id
                ]);
    }
}
