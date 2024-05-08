<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DotType extends Model
{
    use HasFactory;
    protected $table = 'dot_types';
    protected $guarded = false;
}
