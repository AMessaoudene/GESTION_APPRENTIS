<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decisionmaitreapprentis extends Model
{
    protected $table = "decisionmaitreapprentis";
    protected $fillable = [
        'reference',
        'date',
        'bareme_id',
        'pv_id',
        'parametre_id',
        'datedebutsalaireS1',
        'datefinsalaireS1',
        'datedebutsalaireS2',
        'datefinsalaireS2',
        'datedebutsalaireS3',
        'datefinsalaireS3',
        'datedebutsalaireS4',
        'datefinsalaireS4',
        'datedebutsalaireS5',
        'datefinsalaireS5',
    ];
    use HasFactory;
}
