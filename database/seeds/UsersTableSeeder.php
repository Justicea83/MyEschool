<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\App\User::count() == 0){
            $role = Role::where('name', 'super')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'super',
                'email' => 'super@admin.com',
                'role_id'=>$role->id,
                'password' => bcrypt('secret'),
                'verified'=>1
            ]);

        }
    }
}
