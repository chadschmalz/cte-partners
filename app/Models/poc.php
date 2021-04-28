<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poc extends Model
{
    use HasFactory;
    protected $table = 'business_poc';

    protected $dateFormat = 'Y-m-d H:i:s';

      use SoftDeletes;



}
