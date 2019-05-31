<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);


        $admin = factory('App\User')->create(['name' => 'BlueTangerine', 'email' => 'testAdmin@bluetangerine.com']);
        $admin->assignRole('admin');

        $admin = factory('App\User')->create(['name' => 'bob', 'email' => 'bob@gmail.com']);
        $admin->assignRole('user');

        $properties = array();
        $seedImgs = array('seedImage1.jpg', 'seedImage2.jpg', 'seedImage3.jpg');

        for($i = 0; $i < 3; $i++) {
            array_push($properties, factory('App\Property')->create(['admin_id' => $admin->id, 'photo' => $seedImgs[$i]]));
        }

        //$properties = factory('App\Property', 3)->create(['admin_id' => $admin->id]);

        foreach ($properties as $property) {
         factory('App\Comment')->create(['property_id' => $property->id]);
         factory('App\Style', 3)->create(['property_id' => $property->id]);
        }
    }
}
