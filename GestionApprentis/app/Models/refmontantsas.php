<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refmontantsas extends Model
{
    protected $table = 'refmontantsas';
    protected $fillable = [
        'id',
        'refsalariaires_id',
        'diplome_id',
        'tauxas1',
        'montantas1',
        'montantlettresas1',
        'tauxas2',
        'montantas2',
        'montantlettresas2',
        'tauxas3',
        'montantas3',
        'montantlettresas3',
        'tauxas4',
        'montantas4',
        'montantlettresas4',
        'tauxas5',
        'montantas5',
        'montantlettresas5',
    ];
    use HasFactory;
}
