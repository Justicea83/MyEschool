<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::generateFor('academic_infos');
        Permission::generateFor('academic_years');
        Permission::generateFor('assignments');
        Permission::generateFor('assignments');
        Permission::generateFor('attendances');
        Permission::generateFor('classes');
        Permission::generateFor('contacts');
        Permission::generateFor('courses');
        Permission::generateFor('exams');
        Permission::generateFor('fees');
        Permission::generateFor('items');
        Permission::generateFor('occupations');
        Permission::generateFor('religions');
        Permission::generateFor('reports');
        Permission::generateFor('roles');
        Permission::generateFor('schools');
        Permission::generateFor('students');
        Permission::generateFor('student_fee_payments');
        Permission::generateFor('student_academic_infos');
        Permission::generateFor('terms');
        Permission::generateFor('timetables');
        Permission::generateFor('sms');
        Permission::generateFor('users');
    }
}
