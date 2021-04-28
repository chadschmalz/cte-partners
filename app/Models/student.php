<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;


     public function internships()
      {
          return $this->hasMany('App\Models\student_internship','student_id');
      }
      public function employer()
       {
           return $this->hasMany('App\Models\business','id','business_id');
       }
      public function location()
       {
           return $this->belongsTo('App\Models\location');
       }
       public function pathway()
        {
            return $this->belongsTo('App\Models\pathway');
        }


}
