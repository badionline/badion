<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class Subjects extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject=new Subject();
        $subject->name="English";
        $subject->school_id=1;
        $subject->class_id=1;
        $subject->teacher_id=1;
        $subject->save();

        $subject=new Subject();
        $subject->name="English";
        $subject->school_id=1;
        $subject->class_id=2;
        $subject->teacher_id=2;
        $subject->save();

        $subject=new Subject();
        $subject->name="English";
        $subject->school_id=2;
        $subject->class_id=3;
        $subject->teacher_id=3;
        $subject->save();

        $subject=new Subject();
        $subject->name="English";
        $subject->school_id=2;
        $subject->class_id=4;
        $subject->teacher_id=4;
        $subject->save();
    }
}
