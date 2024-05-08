<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "teachers";
    protected $primaryKey = "teacher_id";
//    public function classes()
//    {
//        return $this->belongsTo(Classes::class, 'class_id');
//    }
}
