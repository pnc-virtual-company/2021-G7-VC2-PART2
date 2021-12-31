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
<<<<<<< HEAD
   public function permissions()
=======
    public function permissions()
>>>>>>> 4925808fc05ca8ed6d6cd4a9d07442a833e0898e
   {
       return $this->hasMany(Permission::class, 'id');
   }
   public function user() {
       return $this->belongsTo(User::class);
   }
   
}
