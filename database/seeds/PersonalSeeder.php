<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;
class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('email','justicea83@gmail.com')->first();
        if(!isset($user)){
            $id = (string) Uuid::generate();
            //seeding roles and users for my school
            //insert roles for school
            $role_names = ['admin','accountant','guardian','teacher','student'];
            foreach ($role_names as $name){
                DB::table('roles')->insert([
                    'name'=>$name,
                    'school_id'=>$id,
                    'display_name'=>title_case($name)
                ]);
            }
            $school = \App\Models\School::where('email','unique@manso.com')->first();
            if(!isset($school)){
                DB::table('schools')->insert([
                    'id'=> $id,
                    'name'=>'Unique International School',
                    'location'=>'Manso',
                    'contact'=>'024374444',
                    'alt_contact'=>'023434344',
                    'email'=>'unique@manso.com',
                    'created_at'=>Carbon::now()->toDateTimeString(),
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                ]);
            }
            $role =  Role::where('school_id',$id)
                ->where('name', 'admin')->firstOrFail();
            DB::table('users')->insert([
                'name'=>'Justice Arthur',
                'role_id'=>$role->id,
                'email'=>'justicea83@gmail.com',
                'verified'=>1,
                'password'=>bcrypt('1234'),
                'school_id'=>$id,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            $user = \App\User::where('email','justicea83@gmail.com')->first();

            DB::table('role_user')->insert([
                'user_id'=>$user->id,
                'role_id'=>$role->id
            ]);

            //////
            $role = Role::where('school_id',$id)
                ->where('name', 'admin')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'verified'=>1,
                'role_id'=>$role->id,
                'school_id'=>$id,
                'password' => bcrypt('secret'),
            ]);
            $role = Role::where('school_id',$id)
                ->where('name', 'student')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'student',
                'school_id'=>$id,
                'email' => 'student@admin.com',
                'verified'=>1,
                'role_id'=>$role->id,
                'password' => bcrypt('secret'),
            ]);


            $role = Role::where('school_id',$id)
                ->where('name', 'teacher')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'teacher',
                'email' => 'teacher@admin.com',
                'school_id'=>$id,
                'verified'=>1,
                'role_id'=>$role->id,
                'password' => bcrypt('secret'),
            ]);
            $role = Role::where('school_id',$id)
                ->where('name', 'accountant')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'accountant',
                'email' => 'accountant@admin.com',
                'school_id'=>$id,
                'verified'=>1,
                'role_id'=>$role->id,
                'password' => bcrypt('secret'),
            ]);
            $role = Role::where('school_id',$id)
                ->where('name', 'guardian')->firstOrFail();
            DB::table('users')->insert([
                'name' => 'guardian',
                'school_id'=>$id,
                'email' => 'guardian@admin.com',
                'verified'=>1,
                'role_id'=>$role->id,
                'password' => bcrypt('secret'),
            ]);


            //seed permissions
            $permissions = Permission::all();

            $role = Role::where('school_id',$id)
                ->where('name', 'admin')->firstOrFail();
            $role->perms()->sync(
                $permissions->pluck('id')->all()
            );
        }

    }
}
