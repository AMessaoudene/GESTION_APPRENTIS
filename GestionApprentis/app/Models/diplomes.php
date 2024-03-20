<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diplomes extends Model
{
    protected $table = 'diplomes';
    protected $fillable = [
        'nom',
        'duree',
        'description',
    ];
    use HasFactory;
}
