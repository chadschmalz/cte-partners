<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_internship extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;


     public function student()
      {
          return $this->belongsTo('App\Models\student');
      }
      public function semester()
       {
           return $this->belongsTo('App\Models\semester','semester_id');
       }
       public function employer()
        {
            return $this->belongsTo('App\Models\business','business_id');
        }

}
