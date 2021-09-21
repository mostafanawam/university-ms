<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff';
  //  protected $fillable = ['Fname', 'Mname','Lname','phone','dob','gender','email','image','ssn','userid','language'];
}
