<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pv_installations extends Model
{
    protected $table = 'pv_installations';
    protected $fillable = [
        'id',
        'reference',
        'maitreapprenti_id',
        'apprenti_id',
        'direction',
        'datepv',
        'dateinstallationchiffre',
        'anneeinstallationlettre',
        'moisinstallationlettre',
        'jourinstallationlettre',
        'directionaffectation',
        'serviceaffectation',
        'dotations',
        'status',
    ];
    use HasFactory;
}
