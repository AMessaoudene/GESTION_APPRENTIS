<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supervisions extends Model
{
    protected $table = 'supervisions';
    protected $fillable = [
        'id',
        'apprenti_id',
        'maitreapprenti_id',
        'datedebut',
        'datefin',
        'status',
    ];
    use HasFactory;
}
