<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apprentis extends Model
{
    protected $table = 'apprentis';
    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'civilite',
        'nationalite',
        'adresse',
        'email',
        'telephone',
        'niveauscolaire',
        'specialite',
        'status',
    ];

    use HasFactory;
}
