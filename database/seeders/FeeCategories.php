<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feescategory;

class FeeCategories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fee=new Feescategory();
        $fee->name="Final Year";
        $fee->school_id=1;
        $fee->save();

        $fee=new Feescategory();
        $fee->name="Internal";
        $fee->school_id=1;
        $fee->save();

        $fee=new Feescategory();
        $fee->name="Final Year";
        $fee->school_id=2;
        $fee->save();

        $fee=new Feescategory();
        $fee->name="Internal";
        $fee->school_id=2;
        $fee->save();
    }
}
