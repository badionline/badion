<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class Students extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $student = new Student();
        $student->name = "Mrs. Elyssa Larkin";
        $student->email = "alexis80@yahoo.com";
        $student->phone = "9876543210";
        $student->address = "Surat";
        $student->gender = "M";
        $student->addmissionno = "1";
        $student->profilepic = "Profileimageurl.jpg";
        $student->dob = '2000-01-01';
        $student->aadhaar = "123456781234";
        $student->rollno = 1;
        $student->pname = $faker->name;
        $student->pemail = $faker->email;
        $student->pphone = 9876543210;
        $student->class_id = 1;
        $student->school_id = 1;
        $student->user_id=10000008;
        $student->save();

        $student = new Student();
        $student->name = "Grayson Volkman";
        $student->email = "coby.cronin@morar.info";
        $student->phone = "9876543210";
        $student->address = "Surat";
        $student->gender = "M";
        $student->addmissionno = "1";
        $student->profilepic = "Profileimageurl.jpg";
        $student->dob = '2000-01-01';
        $student->aadhaar = "123456781234";
        $student->rollno = 2;
        $student->pname = $faker->name;
        $student->pemail = $faker->email;
        $student->pphone = 9876543210;
        $student->class_id = 2;
        $student->school_id = 1;
        $student->user_id=10000009;
        $student->save();

        $student = new Student();
        $student->name = "Noble Crist IV";
        $student->email = "lfranecki@mertz.net";
        $student->phone = "9876543210";
        $student->address = "Surat";
        $student->gender = "F";
        $student->addmissionno = "1";
        $student->profilepic = "Profileimageurl.jpg";
        $student->dob = '2000-01-01';
        $student->aadhaar = "123456781234";
        $student->rollno = 3;
        $student->pname = $faker->name;
        $student->pemail = $faker->email;
        $student->pphone = 9876543210;
        $student->class_id = 3;
        $student->school_id = 2;
        $student->user_id=10000010;
        $student->save();

        $student = new Student();
        $student->name = "Jailyn Smith V";
        $student->email = "aida.wilkinson@hotmail.com";
        $student->phone = "9876543210";
        $student->address = "Surat";
        $student->gender = "F";
        $student->addmissionno = "1";
        $student->profilepic = "Profileimageurl.jpg";
        $student->dob = '2000-01-01';
        $student->aadhaar = "123456781234";
        $student->rollno = 4;
        $student->pname = $faker->name;
        $student->pemail = $faker->email;
        $student->pphone = 9876543210;
        $student->class_id = 4;
        $student->school_id = 2;
        $student->user_id=10000011;
        $student->save();
    }
}
