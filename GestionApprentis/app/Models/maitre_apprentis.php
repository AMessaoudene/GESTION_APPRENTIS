<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maitre_apprentis extends Model
{
    protected $table = 'maitre_apprentis';
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'civilite',
        'email',
        'telephonepro',
        'adresse',
        'fonction',
        'numapprentissupervises',
        'daterecrutement',
        'status',
        'apprenti1_id',
        'apprenti2_id',
    ];
    use HasFactory;
}
