<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $fillable = ['discipline_type', 'date_time', 'explaination'];
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

}
