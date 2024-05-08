<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class Plans extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan=new Plan();
        $plan->title="Free";
        $plan->duration="1 Year";
        $plan->description="This is an welcome plan";
        $plan->save();
    }
}
