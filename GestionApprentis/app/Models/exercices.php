<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercices extends Model
{
    protected $table = 'exercices';
    protected $fillable = [
        'id',
        'annee',
        'datedebut',
        'datefin',
        'nombrebesoins',
        'massesalariare',
        'budget',
    ];
    use HasFactory;
}
