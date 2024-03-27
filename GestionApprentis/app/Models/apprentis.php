<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprentis extends Model
{
    protected $table = 'apprentis';
    protected $fillable = [
        'id',
        'numcontrat',
        'datecontrat',
        'datedebut',
        'datefin',
        'nom',
        'prenom',
        'civilite',
        'datenaissance',
        'nationalite',
        'adresse',
        'email',
        'telephone',
        'niveauscolaire',
        'specialite',
        'structure_id',
        'diplome1_id',
        'diplome2_id',
        'status',
    ];

    use HasFactory;
}
