<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Faker\Factory as Faker;

class Teachers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();

        $teacher1=new Teacher();
        $teacher1->name="Maverick Wilderman I";
        $teacher1->email="olabadie@nicolas.com";
        $teacher1->gender="M";
        $teacher1->phone="9876543210";
        $teacher1->address="Surat";
        $teacher1->graduation="BBA";
        $teacher1->dob='2000-01-01';
        $teacher1->salary="10000";
        $teacher1->profilepic="ImagePath";
        $teacher1->aadhaar="123456781234";
        $teacher1->school_id="1";
        $teacher1->class_id="1";
        $teacher1->user_id= "10000004";
        $teacher1->save();

        $teacher2=new Teacher();
        $teacher2->name="Filomena Emard";
        $teacher2->email="chaz05@lemke.com";
        $teacher2->gender="M";
        $teacher2->phone="9876543210";
        $teacher2->address="Surat";
        $teacher2->graduation="BBA";
        $teacher2->dob='2000-01-01';
        $teacher2->salary="10000";
        $teacher2->profilepic="ImagePath";
        $teacher2->aadhaar="123456781234";
        $teacher2->school_id="1";
        $teacher2->class_id="2";
        $teacher2->user_id= "10000005";
        $teacher2->save();

        $teacher3=new Teacher();
        $teacher3->name="Cynthia Johnson II";
        $teacher3->email="braun.adela@ritchie.com";
        $teacher3->gender="M";
        $teacher3->phone="9876543210";
        $teacher3->address="Surat";
        $teacher3->graduation="BBA";
        $teacher3->dob='2000-01-01';
        $teacher3->salary="10000";
        $teacher3->profilepic="ImagePath";
        $teacher3->aadhaar="123456781234";
        $teacher3->school_id="2";
        $teacher3->class_id="3";
        $teacher3->user_id= "10000006";
        $teacher3->save();

        $teacher4=new Teacher();
        $teacher4->name="Miss Nelle Paucek";
        $teacher4->email="aurore58@hotmail.com";
        $teacher4->gender="M";
        $teacher4->phone="9876543210";
        $teacher4->address="Surat";
        $teacher4->graduation="BBA";
        $teacher4->dob='2000-01-01';
        $teacher4->salary="10000";
        $teacher4->profilepic="ImagePath";
        $teacher4->aadhaar="123456781234";
        $teacher4->school_id="2";
        $teacher4->class_id="4";
        $teacher4->user_id= "10000007";
        $teacher4->save();
    }
}
