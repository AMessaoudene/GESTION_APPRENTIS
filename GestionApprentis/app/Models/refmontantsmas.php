<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refmontantsmas extends Model
{
    protected $table = "refmontantsmas";
    protected $fillable = [
        'id',
        'refsalariaires_id',
        'diplome_id',
        'tauxmas1',
        'montantmas1',
        'montantlettresmas1',
        'tauxmas2',
        'montantmas2',
        'montantlettresmas2',
        'tauxmas3',
        'montantmas3',
        'montantlettresmas3',
        'tauxmas4',
        'montantmas4',
        'montantlettresmas4',
        'tauxmas5',
        'montantmas5',
        'montantlettresmas5',
    ];
    use HasFactory;
}
