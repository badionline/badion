<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
        $this->call([
            Users::class
        ]);
        $this->call([
            AdminSeeder::class
        ]);
        // $this->call([
        //     Plans::class
        // ]);
        // $this->call([
        //     SchoolsSeeder::class
        // ]);
        // $this->call([
        //     ClassesSeeder::class
        // ]);
        // $this->call([
        //     Subscribes::class
        // ]);
        // $this->call([
        //     Tickets::class
        // ]);
        // $this->call([
        //     Payments::class
        // ]);
        // $this->call([
        //     Teachers::class
        // ]);
        // $this->call([
        //     Salaries::class
        // ]);
        // $this->call([
        //     Students::class
        // ]);
        // $this->call([
        //     FeeCategories::class
        // ]);
        // $this->call([
        //     Fees::class
        // ]);
        // $this->call([
        //     Exams::class
        // ]);
        // $this->call([
        //     Subjects::class
        // ]);
        // $this->call([
        //     StudyMaterials::class
        // ]);
        // $this->call([
        //     Attendances::class
        // ]);
        // $this->call([
        //     HomeworkSeeder::class
        // ]);
        // $this->call([
        //     Results::class
        // ]);
        // $this->call([
        //     Notices::class
        // ]);
        // $this->call([
        //     Timetables::class
        // ]);
        // $this->call([
        //     Teacherstimetable::class
        // ]);
    }
}