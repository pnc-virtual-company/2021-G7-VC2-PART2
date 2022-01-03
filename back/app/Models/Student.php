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
    public function permissions()
   {
       return $this->hasMany(Permission::class, 'id');
   }

   public function discipline()
   {
       return $this->hasMany(Discipline::class, 'id');
   }
   public function user() {
       return $this->belongsTo(User::class);
   }

}
