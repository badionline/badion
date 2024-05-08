<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Homework;

class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homework=new Homework();
        $homework->content="Homework-1";
        $homework->file="homework.pdf";
        $homework->school_id=1;
        $homework->class_id=1;
        $homework->subject_id=1;
        $homework->save();
        
        $homework=new Homework();
        $homework->content="Homework-1";
        $homework->file="homework.pdf";
        $homework->school_id=1;
        $homework->class_id=2;
        $homework->subject_id=2;
        $homework->save();
        
        $homework=new Homework();
        $homework->content="Homework-1";
        $homework->file="homework.pdf";
        $homework->school_id=2;
        $homework->class_id=3;
        $homework->subject_id=3;
        $homework->save();
        
        $homework=new Homework();
        $homework->content="Homework-1";
        $homework->file="homework.pdf";
        $homework->school_id=2;
        $homework->class_id=4;
        $homework->subject_id=4;
        $homework->save();
    }
}
