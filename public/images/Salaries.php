<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Salary;

class Salaries extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salary1 = new Salary();
        $salary1->amount = 10000;
        $salary1->status = 0;
        $salary1->school_id = 1;
        $salary1->teacher_id = 1;
        $salary1->save();

        $salary2 = new Salary();
        $salary2->amount = 10000;
        $salary2->status = 1;
        $salary2->school_id = 1;
        $salary2->teacher_id = 2;
        $salary2->save();

        $salary3 = new Salary();
        $salary3->amount = 10000;
        $salary3->status = 0;
        $salary3->school_id = 2;
        $salary3->teacher_id = 3;
        $salary3->save();

        $salary4 = new Salary();
        $salary4->amount = 10000;
        $salary4->status = 1;
        $salary4->school_id = 2;
        $salary4->teacher_id = 4;
        $salary4->save();
    }
}
