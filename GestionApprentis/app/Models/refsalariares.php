<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refsalariares extends Model
{
    protected $table = 'refsalariaires';
    protected $fillable = [
        'id',
        'version',
        'snmg',
        'salairereference',
        'status',
    ];
    use HasFactory;
}
