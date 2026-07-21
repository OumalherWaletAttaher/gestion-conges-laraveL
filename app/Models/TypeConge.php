<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeConge extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function demandeConges(){
        return $this->hasMany(DemandeConge::class);
    }
}
