<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Studymaterial;

class StudyMaterials extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studymaterial=new Studymaterial;
        $studymaterial->name="English";
        $studymaterial->file="filepath.pdf";
        $studymaterial->school_id=1;
        $studymaterial->class_id=1;
        $studymaterial->subject_id=1;
        $studymaterial->save();
        
        $studymaterial=new Studymaterial;
        $studymaterial->name="English";
        $studymaterial->file="filepath.pdf";
        $studymaterial->school_id=1;
        $studymaterial->class_id=2;
        $studymaterial->subject_id=2;
        $studymaterial->save();
        
        $studymaterial=new Studymaterial;
        $studymaterial->name="English";
        $studymaterial->file="filepath.pdf";
        $studymaterial->school_id=1;
        $studymaterial->class_id=1;
        $studymaterial->subject_id=3;
        $studymaterial->save();
        
        $studymaterial=new Studymaterial;
        $studymaterial->name="English";
        $studymaterial->file="filepath.pdf";
        $studymaterial->school_id=1;
        $studymaterial->class_id=1;
        $studymaterial->subject_id=4;
        $studymaterial->save();
    }
}
