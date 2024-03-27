<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decisionapprentis extends Model
{
    protected $table = "decisionapprentis";
    protected $fillable = [
        'reference',
        'date',
        'pv_id',
        'parametre_id',
        'datetransfert'
    ];
    use HasFactory;
}
