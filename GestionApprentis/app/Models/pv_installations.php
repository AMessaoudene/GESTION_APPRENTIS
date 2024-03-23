<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pv_installations extends Model
{
    protected $table = 'pv_installations';
    protected $fillable = [
        'reference',
        'apprenti_id',
        'maitreapprenti_id',
        'contratapprenti_id',
        'direction',
        'dateinstallationapprenti',
        'directionaffection',
        'serviceaffectation',
        'pdf',
        'status',
    ];
    use HasFactory;
}
