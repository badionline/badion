<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feescategory extends Model
{
    use HasFactory;
    protected $table = "feescategories";
    protected $primaryKey = "feescategory_id";
}
