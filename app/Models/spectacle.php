<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spectacle extends Model
{
    use HasFactory;

    protected $table = 'spectacles'; // Nom de la table si différent du nom par défaut
    protected $fillable = [
        'piece',
        'salle',
        'date spectacle'

        ];
}
