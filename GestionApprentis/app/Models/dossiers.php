<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossiers extends Model
{
    protected $table = 'dossiers';
    protected $fillable = [
        'status',
        'motif',
    ];
    use HasFactory;
}
