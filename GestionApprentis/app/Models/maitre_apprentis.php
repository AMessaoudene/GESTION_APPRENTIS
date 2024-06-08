<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apprentis;
use App\Models\Diplomes;

class Maitre_Apprentis extends Model
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
        'apprenti1_id',
        'apprenti2_id',
        'daterecrutement',
        'affectation',
        'status',
    ];

    use HasFactory;

    public function apprentis()
    {
        return $this->hasMany(Apprentis::class);
    }

    public function diplome() {
        return $this->belongsTo(Diplomes::class, 'diplome_id');
    }
}
