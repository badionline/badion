<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class Tickets extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticket1=new Ticket();
        $ticket1->description="This is an Testing Ticket From School-1 (Opened Ticket)";
        $ticket1->attachment="File path of attachment if School adds";
        $ticket1->school_id="1";
        $ticket1->save();

        $ticket2=new Ticket();
        $ticket2->description="This is an Testing Ticket From School-1 (Resolved Ticket)";
        $ticket2->attachment="File path of attachment if School adds";
        $ticket2->school_id="1";
        $ticket2->save();

        $ticket3=new Ticket();
        $ticket3->description="This is an Testing Ticket From School-2 (Opened Ticket)";
        $ticket3->attachment="File path of attachment if School adds";
        $ticket3->school_id="2";
        $ticket3->save();

        $ticket4=new Ticket();
        $ticket4->description="This is an Testing Ticket From School-2 (Resolved Ticket)";
        $ticket4->attachment="File path of attachment if School adds";
        $ticket4->school_id="2";
        $ticket4->save();
    }
}
