<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'class',
        'phone',
        'gender'
    ];
   public function Permission()
   {
       return $this->hashMany(Permission::class);
   }
   public function Discipline()
   {
       return $this->hashMany(Discipline::class, 'id');
   }
}
