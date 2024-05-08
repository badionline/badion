<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fee;

class Fees extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fee=new Fee();
        $fee->amount=10000;
        $fee->feescategory_id=1;
        $fee->school_id=1;
        $fee->class_id=1;
        $fee->save();

        $fee=new Fee();
        $fee->amount=10000;
        $fee->feescategory_id=2;
        $fee->school_id=1;
        $fee->class_id=2;
        $fee->save();

        $fee=new Fee();
        $fee->amount=10000;
        $fee->feescategory_id=3;
        $fee->school_id=2;
        $fee->class_id=3;
        $fee->save();

        $fee=new Fee();
        $fee->amount=10000;
        $fee->feescategory_id=4;
        $fee->school_id=2;
        $fee->class_id=4;
        $fee->save();
    }
}
