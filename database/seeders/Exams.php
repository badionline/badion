<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;

class Exams extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exam=new Exam();
        $exam->name="Final Year";
        $exam->timetable="timetable.pdf";
        $exam->school_id=1;
        $exam->class_id=1;
        $exam->save();
        
        $exam=new Exam();
        $exam->name="Final Year";
        $exam->timetable="timetable.pdf";
        $exam->school_id=1;
        $exam->class_id=2;
        $exam->save();
        
        $exam=new Exam();
        $exam->name="Final Year";
        $exam->timetable="timetable.pdf";
        $exam->school_id=2;
        $exam->class_id=3;
        $exam->save();
        
        $exam=new Exam();
        $exam->name="Final Year";
        $exam->timetable="timetable.pdf";
        $exam->school_id=2;
        $exam->class_id=4;
        $exam->save();
    }
}
