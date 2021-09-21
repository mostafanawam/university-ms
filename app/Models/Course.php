<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
       protected $fillable = ['Code','Name', 'description','Credits','Semester'];
      public $timestamps = false;

      public function scopeSearch($query,$val){
        return $query
        ->where('Code','like','%'.$val.'%')
        ->orwhere('Name','like','%'.$val.'%')
        ->orwhere('description','like','%'.$val.'%')
        ->orwhere('Credits','like','%'.$val.'%')
        ->orwhere('Semester','like','%'.$val.'%')
        ;
      }

}
