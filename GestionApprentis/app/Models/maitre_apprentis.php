<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\apprentis;

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
        'apprenti1_id',
        'apprenti2_id',
        'numapprentissupervises',
        'daterecrutement',
        'affectation',
        'status',
    ];
    use HasFactory;
    public function apprentis()
    {
        return $this->hasMany(Apprentis::class);
    }
}
