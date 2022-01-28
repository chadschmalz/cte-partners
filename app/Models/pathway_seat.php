<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pathway_seat extends Model
{
    use HasFactory;
    protected $table = 'pathway_seats';

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;

      public function pathway()
       {
           return $this->belongsto('App\Models\pathway');
       }
       public function semester()
        {
            return $this->belongsto('App\Models\semester');
        }

}
