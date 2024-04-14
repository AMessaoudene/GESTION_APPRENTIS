<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baremes extends Model
{
    protected $table = 'baremes';
    protected $fillable = [
        'id',
        'refsalariares_id',
        'diplome_id',
        'tauxs1_apprentis',
        'montantchiffres1_apprentis',
        'montantlettres1_apprentis',
        'tauxs2_apprentis',
        'montantchiffres2_apprentis',
        'montantlettres2_apprentis',
        'tauxs3_apprentis',
        'montantchiffres3_apprentis',
        'montantlettres3_apprentis',
        'tauxs4_apprentis',
        'montantchiffres4_apprentis',
        'montantlettres4_apprentis',
        'tauxs5_apprentis',
        'montantchiffres5_apprentis',
        'montantlettres5_apprentis',
        'tauxs1_maitreapprentis',
        'montantchiffres1_maitreapprentis',
        'montantlettres1_maitreapprentis',
        'tauxs2_maitreapprentis',
        'montantchiffres2_maitreapprentis',
        'montantlettres2_maitreapprentis',
        'tauxs3_maitreapprentis',
        'montantchiffres3_maitreapprentis',
        'montantlettres3_maitreapprentis',
        'tauxs4_maitreapprentis',
        'montantchiffres4_maitreapprentis',
        'montantlettres4_maitreapprentis',
        'tauxs5_maitreapprentis',
        'montantchiffres5_maitreapprentis',
        'montantlettres5_maitreapprentis',
        'statut',
    ];
    use HasFactory;
}
