<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planbesoins extends Model
{
    protected $table = 'planbesoins';
    protected $fillable = [
        'exercice_id',
        'reference',
        'structure_id',
        'date',
        'nombreapprentis',
        'nombereffectif',
        'nombreapprentismax',
        'description',
        'status',
    ];
    use HasFactory;
}
