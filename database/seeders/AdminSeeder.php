<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->name = "BadiOn";
        $admin->email = "badionlineinfo@gmail.com";
        $admin->phone = "9924847147";
        $admin->address = "Surat";
        $admin->user_id = 10000001;
        $admin->save();
    }
}
