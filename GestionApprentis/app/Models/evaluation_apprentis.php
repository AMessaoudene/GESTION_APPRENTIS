<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation_apprentis extends Model
{
    protected $table = "evaluation_apprentis";
    protected $fillable = [
        'apprenti_id',
        'structureattache',
        'datedebut',
        'datefin',
        'comportementsociabilite',
        'observationcs',
        'communication',
        'observationc',
        'organisationhygiene',
        'observationoh',
        'ponctualiteassiduite',
        'observationpa',
        'respectreglementinterieur',
        'observationrri',
        'discipline',
        'observationd',
        'interettravail',
        'observationit',
        'motivation',
        'observationm',
        'espritinitiative',
        'observationei',
        'evolutionprocessusintegration',
        'observationepi',
        'qualificationsprofessionelles',
        'observationqp',
        'sensresponsabilite',
        'observationsr',
    ];

    use HasFactory;
}
