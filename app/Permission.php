<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public static function generateFor($table_name)
    {
        self::firstOrCreate(['name' => 'browse_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['name' => 'read_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['name' => 'edit_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['name' => 'add_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['name' => 'delete_'.$table_name, 'table_name' => $table_name]);
    }

    public static function removeFrom($table_name)
    {
        self::where(['table_name' => $table_name])->delete();
    }
}
