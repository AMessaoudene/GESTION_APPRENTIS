<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\maitre_apprentis;

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
    public function maitreApprenti()
    {
        return $this->belongsTo(maitre_apprentis::class);
    }
    use HasFactory;
}
