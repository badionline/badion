<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notice;

class Notices extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notice=new Notice();
        $notice->title="Event";
        $notice->description="Notice Board";
        $notice->file="notice.pdf";
        $notice->to=1;
        $notice->school_id=1;
        $notice->save();
        
        $notice=new Notice();
        $notice->title="Event";
        $notice->description="Notice Board";
        $notice->file="notice.pdf";
        $notice->to=2;
        $notice->school_id=2;
        $notice->save();
    }
}
