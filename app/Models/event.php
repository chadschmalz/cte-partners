<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;

      public function location()
      {
          return $this->belongsTo('App\Models\location');
      }
      public function business()
      {
          return $this->belongsTo('App\Models\business');
      }
      public function cluster()
      {
          return $this->belongsTo('App\Models\cluster');
      }
      public function pathway()
      {
          return $this->belongsTo('App\Models\pathway');
      }
      public function activity()
      {
          return $this->belongsTo('App\Models\activity');
      }
}
