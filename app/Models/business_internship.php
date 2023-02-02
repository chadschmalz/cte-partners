<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class business_internship extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;

       public function business()
        {
            return $this->belongsto('App\Models\business');
        }
        public function pathway()
        {
            return $this->belongsto('App\Models\pathway');
        }

}
