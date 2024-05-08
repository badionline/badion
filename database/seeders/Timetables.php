<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timetable;

class Timetables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timetable=new Timetable();
        $timetable->file="timetable.pdf";
        $timetable->school_id=1;
        $timetable->class_id=1;
        $timetable->save();
        
        $timetable=new Timetable();
        $timetable->file="timetable.pdf";
        $timetable->school_id=1;
        $timetable->class_id=2;
        $timetable->save();
        
        $timetable=new Timetable();
        $timetable->file="timetable.pdf";
        $timetable->school_id=2;
        $timetable->class_id=3;
        $timetable->save();
        
        $timetable=new Timetable();
        $timetable->file="timetable.pdf";
        $timetable->school_id=2;
        $timetable->class_id=4;
        $timetable->save();
    }
}
