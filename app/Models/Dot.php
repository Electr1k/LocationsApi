<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dot extends Model
{
    use HasFactory;

    protected $table = 'dots';
    protected $guarded = false;
}
