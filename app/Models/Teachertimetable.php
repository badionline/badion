<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachertimetable extends Model
{
    use HasFactory;
    protected $table = "teachertimetables";
    protected $primaryKey = "timetable_id";
}
