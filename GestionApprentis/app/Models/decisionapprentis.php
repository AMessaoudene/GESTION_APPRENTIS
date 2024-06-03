<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decisionapprentis extends Model
{
    protected $table = "decisionapprentis";
    protected $fillable = [
        'reference',
        'planbesoins_id',
        'date',
        'pv_id',
        'bareme_id',
        'parametre_id',
        'datetransfert',
        'datedebutpresalaireS1',
        'datefinpresalaireS1',
        'datedebutpresalaireS2',
        'datefinpresalaireS2',
        'datedebutpresalaireS3',
        'datefinpresalaireS3',
        'datedebutpresalaireS4',
        'datefinpresalaireS4',
        'datedebutpresalaireS5',
        'datefinpresalaireS5',
    ];
    use HasFactory;
}
