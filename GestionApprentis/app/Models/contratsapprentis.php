<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contratsapprentis extends Model
{
    protected $table = "contrats_apprentis";
    protected $fillable = [
        'numcontrat',
        'apprenti_id',
        'datecontrat',
        'datedebut',
        'datefin',
        'datetransfert',
        'pdf',
        'status',
        //affectation
    ];
    use HasFactory;
}
