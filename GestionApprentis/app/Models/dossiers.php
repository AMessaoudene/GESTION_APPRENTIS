<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dossiers extends Model
{
    protected $table = 'dossiers';
    protected $fillable = [
        'apprenti_id',
        'contratapprenti',
        'decisionapprenti',
        'decisionmaitreapprenti',
        'pvinstallation',
        'copiecheque',
        'extraitnaissance',
        'autorisationparentele',
        'photo',
        'status',
        'motif',
    ];
    use HasFactory;
}
