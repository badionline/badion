<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schools;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school=new Schools();
        $school->name="BMU";
        $school->address="Surat";
        $school->email="bmu@gmail.com";
        $school->phone="9924847147";
        $school->location="https://g.co/kgs/wriR3mP";
        $school->whatsapp="https://wa.me/9924847147";
        $school->youtube="https://www.youtube.com/@chintala5817";
        $school->instagram="https:/instagram.com/rahulhemaraju";
        $school->adhaar="123456789012";
        $school->adhaarfront="imageurl";
        $school->adhaarback="imageurl";
        $school->pan="147258369";
        $school->panfile="panurl";
        $school->registernumber="1234567890";
        $school->status="1";
        $school->user_id=10000002;
        $school->save();

        $school2=new Schools();
        $school2->name="BMCCA";
        $school2->address="Surat";
        $school2->email="bmcca@gmail.com";
        $school2->phone="9924847147";
        $school2->location="https://g.co/kgs/wriR3mP";
        $school2->whatsapp="https://wa.me/9924847147";
        $school2->youtube="https://www.youtube.com/@chintala5817";
        $school2->instagram="https:/instagram.com/rahulhemaraju";
        $school2->adhaar="123456789012";
        $school2->adhaarfront="imageurl";
        $school2->adhaarback="imageurl";
        $school2->pan="147258369";
        $school2->panfile="panurl";
        $school2->registernumber="1234567890";
        $school2->status="1";
        $school2->user_id=10000003;
        $school2->save();
    }
}
