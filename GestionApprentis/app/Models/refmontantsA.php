<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refmontantsA extends Model
{
    protected $table = 'refmontantsA';
    protected $fillable = [
        'id',
        'tauxAS1',
        'montantAS1',
        'montantlettresAS1',
        'tauxAS2',
        'montantAS2',
        'montantlettresAS2',
        'tauxAS3',
        'montantAS3',
        'montantlettresAS3',
        'tauxAS4',
        'montantAS4',
        'montantlettresAS4',
        'tauxAS5',
        'montantAS5',
        'montantlettresAS5',
    ];
    use HasFactory;
}
