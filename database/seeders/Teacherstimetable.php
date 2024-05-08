<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teachertimetable;

class Teacherstimetable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timetable=new Teachertimetable();
        $timetable->file="teachertimetable.pdf";
        $timetable->school_id=1;
        $timetable->teacher_id=1;
        $timetable->save();
        
        $timetable=new Teachertimetable();
        $timetable->file="teachertimetable.pdf";
        $timetable->school_id=1;
        $timetable->teacher_id=2;
        $timetable->save();
        
        $timetable=new Teachertimetable();
        $timetable->file="teachertimetable.pdf";
        $timetable->school_id=2;
        $timetable->teacher_id=3;
        $timetable->save();
        
        $timetable=new Teachertimetable();
        $timetable->file="teachertimetable.pdf";
        $timetable->school_id=2;
        $timetable->teacher_id=4;
        $timetable->save();
    }
}
