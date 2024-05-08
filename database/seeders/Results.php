<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Result;

class Results extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $result=new Result();
        $result->marks="95";
        $result->subject_id=3;
        $result->class_id=3;
        $result->school_id=2;
        $result->exam_id=3;
        $result->student_id=3;
        $result->save();

        $result=new Result();
        $result->marks="A";
        $result->subject_id=4;
        $result->class_id=4;
        $result->school_id=2;
        $result->exam_id=4;
        $result->student_id=4;
        $result->save();

        $result=new Result();
        $result->marks="95";
        $result->subject_id=1;
        $result->class_id=1;
        $result->school_id=1;
        $result->exam_id=1;
        $result->student_id=1;
        $result->save();

        $result=new Result();
        $result->marks="95";
        $result->subject_id=2;
        $result->class_id=2;
        $result->school_id=1;
        $result->exam_id=2;
        $result->student_id=2;
        $result->save();
    }
}
