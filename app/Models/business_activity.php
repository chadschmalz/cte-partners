<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class business_activity extends Model
{
    use HasFactory;
    protected $table = 'business_activities';

    protected $dateFormat = 'Y-m-d H:i:s';

      public function activity()
       {
           return $this->belongsto('App\Models\activity');
       }
       public function business()
        {
            return $this->belongsto('App\Models\business');
        }

}
