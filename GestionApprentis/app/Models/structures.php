<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class structures extends Model
{
    protected $table = 'structures';
    protected $fillable = [
        'nom',
        'nomresponsable',
    ];
    use HasFactory;
}
