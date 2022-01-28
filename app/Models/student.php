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


      public function couselor()
       {
           return $this->hasMany('App\Models\counselor','location_id','location_id');
       }
     public function internships()
      {
          return $this->hasMany('App\Models\student_internship','student_id');
      }
      public function semesters()
       {
           return $this->hasMany('App\Models\student_semester','student_id','id');
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

      public function hasSemesters($semesters)
       {
           if (is_array($semesters)) {
               foreach ($semesters as $sem) {
                   if ($this->hasSemester($sem)) {
                       return true;
                   }
               }
           } else {
               if ($this->hasSemester($sem)) {
                   return true;
               }
           }
           return false;
       }
       public function hasSemester($sem)
    {
        if ($this->semesters()->where('semester_desc',$sem)->first()) {
            return true;
        }
        return false;
    }

}
