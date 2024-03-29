<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\diplomes;
use App\Models\maitre_apprentis;
use App\Models\structures;
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
        'nationalite',
        'datenaissance',
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
