<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feestatus extends Model
{
    use HasFactory;
    protected $table = "feestatuses";
    protected $primaryKey = "feestatus_id";
}
