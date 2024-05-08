<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscribe;
use Carbon\Carbon;

class Subscribes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscribe1=new Subscribe();
        $subscribe1->from=Carbon::now();
        $subscribe1->to=Carbon::now()->copy()->addYear();
        $subscribe1->school_id=1;
        $subscribe1->plan_id=1;
        $subscribe1->save();

        $subscribe2=new Subscribe();
        $subscribe2->from=Carbon::now();
        $subscribe2->to=Carbon::now()->copy()->addYear();
        $subscribe2->school_id=2;
        $subscribe2->plan_id=1;
        $subscribe2->save();
    }
}
