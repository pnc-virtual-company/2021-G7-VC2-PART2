<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'student_name', 'start_date', 'end_date', 'leave_type', 'description'];
    public function Permission(){
        return $this->belongsTo(Student::class);
    }

}
