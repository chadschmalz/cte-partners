<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vbusiness_summary extends Model
{
    use HasFactory;
    protected $table = 'vBusinessSummary';

    protected $dateFormat = 'Y-m-d H:i:s';


    public function pocs()
     {
         return $this->hasMany('App\Models\poc');
     }
     public function pathways()
      {
          return $this->hasMany('App\Models\business_pathway');
      }

    public function activities()
     {
         return $this->hasMany('App\Models\business_activity');
     }
     public function studentinternships()
      {
          return $this->hasMany('App\Models\student_internship','business_id');
      }
      public function internships()
      {
          return $this->hasMany('App\Models\business_internship');
      }


}
