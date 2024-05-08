<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class1=new Classes();
        $class1->name="1st";
        $class1->div="A";
        $class1->school_id="1";
        $class1->save();

        $class2=new Classes();
        $class2->name="2nd";
        $class2->div="A";
        $class2->school_id="1";
        $class2->save();

        $class3=new Classes();
        $class3->name="1st";
        $class3->div="A";
        $class3->school_id="2";
        $class3->save();

        $class4=new Classes();
        $class4->name="2nd";
        $class4->div="A";
        $class4->school_id="2";
        $class4->save();
    }
}
