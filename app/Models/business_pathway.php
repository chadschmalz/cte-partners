<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class business_pathway extends Model
{
    use HasFactory;
    protected $table = 'business_pathways';

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;


      public function pathway()
       {
           return $this->belongsto('App\Models\pathway');
       }
       public function cluster()
        {
            return $this->belongsto('App\Models\cluster');
        }

}
