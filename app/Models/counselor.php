<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class counselor extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;


     

}
