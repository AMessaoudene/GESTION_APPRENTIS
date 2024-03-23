<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation_maitre_apprentis extends Model
{
    protected $table = 'evaluation_maitre_apprentis';
    protected $fillable = [
        'reference',
        'structureattache',
        'datedebut',
        'datefin',
        'sensresponsabilite',
        'observationsr',
        'disponibiliteorientationapprenti',
        'observationdoa',
        'respectmissionencadrement',
        'observationrme',
        'effetpoursuiviapprenti',
        'observationepsa',
        'qualiteencadrementapprenti',
        'observationqea',
        'avisapprenti',
    ];
    use HasFactory;
}
