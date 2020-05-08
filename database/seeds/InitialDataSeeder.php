<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('links')->truncate();
        DB::table('resource_groups')->truncate();
        DB::table('applications')->truncate();
        DB::table('users')->truncate();

        //users
        $user_id = Str::orderedUuid();
        DB::table('users')->insert([
            'id' => $user_id,
            'username' => 'admin',
            'id_number' => '0000-00000',
            'type' => 'Employee',
            'name' => 'Super Admin',
            'first_name' => 'Super',
            'middle_name' => '',
            'last_name' => 'Admin',
            'email' => 'admin@apc.edu.ph',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()
        ]);

        //Role
        $role_id = \Illuminate\Support\Str::orderedUuid();
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            'id' => $role_id,
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'description' => 'Super administrator rights',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => \Illuminate\Support\Str::orderedUuid(),
            'name' => 'Admin',
            'guard_name' => 'web',
            'description' => 'Administrator rights',
            'created_at' => \Carbon\Carbon::now()
        ]);

        //User role
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_roles')->insert([
            'role_id' => $role_id,
            'model_type' => 'Modules\User\Entities\User',
            'model_id' => $user_id
        ]);

        $app_id = Str::orderedUuid();
        //applications
        DB::table('applications')->insert([
            'id' => $app_id,
            'name' => 'Administration App',
            'description' => 'Administration application',
            'icon' => 'fa fa-cogs',
            'url' => 'http://app.master',
            'created_at' => Carbon::now()
        ]);

        $resource_id = Str::orderedUuid();
        //resource_groups
        DB::table('resource_groups')->insert([
            'id' => $resource_id,
            'application_id' => $app_id,
            'name' => 'Administration',
            'icon' => 'fa fa-cogs',
            'created_at' => Carbon::now()
        ]);

        //links
        DB::table('links')->insert([
            'id' => Str::orderedUuid(),
            'application_id' => $app_id,
            'resource_group_id' => $resource_id,
            'title' => 'Links',
            'url' => '/link',
            'icon' => 'fa fa-link',
            'active_pattern' => '/link*',
            'created_at' => Carbon::now()
        ]);
    }
}
