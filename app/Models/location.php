<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;


     public function students()
      {
          return $this->hasMany('App\Models\student');
      }
      public function events()
      {
          return $this->hasMany('App\Models\event');
      }  
      public function conesite()
      {
          return $this->belongsTo('App\Models\conesite');
      }

}
