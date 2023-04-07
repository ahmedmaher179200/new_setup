<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //role seeder
        // $role = Role::firstOrCreate([
        //     'name'          => 'الادارة',
        //     'display_name'  => 'الادارة',
        //     'description'   => 'can do any thing',
        // ]);

        // foreach(config('global.roles') as $key => $values){
        //     foreach($values as $value){
        //         $sub_role = Permission::firstOrCreate([
        //             'name'          => $value . '-' . $key,
        //             'display_name'  => $value . ' ' . $key,
        //             'description'   => $value . ' ' . $key,
        //         ]);
                
        //         $role->attachPermissions([$sub_role]);
        //     }
        // }
    }
}
