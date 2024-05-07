<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departs extends Model
{
    protected $table = 'departs';
    protected $fillable = [
        'id',
        'apprenti_id',
        'datedepart',
        'motif',
        'refcourrier',
        'datecourrier',
    ];
    use HasFactory;
}
