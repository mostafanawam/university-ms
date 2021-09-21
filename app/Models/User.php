<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'password','type'];

    public function scopeSearch($query,$val){
      return $query
      ->where('id','like','%'.$val.'%')
      ->orwhere('type','like','%'.$val.'%')
      ;
    }
}
