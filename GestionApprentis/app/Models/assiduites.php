<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assiduites extends Model
{
    protected $table = 'assiduites';
    protected $fillable = [
        'apprenti_id',
        'type',
        'datedebut',
        'datefin',
        'motif',
    ];
    use HasFactory;
}
