<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;

class Attendances extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attendance = new Attendance;
        $attendance->date = now();
        $attendance->status = "P";
        $attendance->student_id = 1;
        $attendance->class_id = 1;
        $attendance->school_id = 1;
        $attendance->save();
    }
}
