<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refmontantsMA extends Model
{
    protected $table = 'refmontantsMA';
    protected $fillable = [
        'id',
        'tauxMAS1',
        'montantMAS1',
        'montantlettresMAS1',
        'tauxMAS2',
        'montantMAS2',
        'montantlettresMAS2',
        'tauxMAS3',
        'montantMAS3',
        'montantlettresMAS3',
        'tauxMAS4',
        'montantMAS4',
        'montantlettresMAS4',
        'tauxMAS5',
        'montantMAS5',
        'montantlettresMAS5',
    ];
    use HasFactory;
}
