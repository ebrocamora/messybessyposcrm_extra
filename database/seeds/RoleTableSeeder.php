<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'id'=>\Illuminate\Support\Str::orderedUuid(),
            'name'=>'Super Admin',
            'guard_name'=>'web',
            'description'=>'Super administrator rights',
            'created_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('roles')->insert([
            'id'=>\Illuminate\Support\Str::orderedUuid(),
            'name'=>'Admin',
            'guard_name'=>'web',
            'description'=>'Administrator rights',
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
