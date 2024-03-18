<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maitre_apprentis extends Model
{
    protected $table = 'maitre_apprentis';
    protected $fillable = [
        'nom',
        'prenom',
        'civilite',
        'email',
        'telephonepro',
        'adresse',
        'fonction',
        'numapprentissupervises',
        'daterecrutement',
    ];
    use HasFactory;
}
