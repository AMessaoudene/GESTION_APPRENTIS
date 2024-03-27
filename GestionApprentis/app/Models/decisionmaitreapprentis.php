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
        'pv_id',
        'parametre_id',
    ];
    use HasFactory;
}
