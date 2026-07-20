<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeConge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'motif',
        'statut',
    ];

    protected $casts = [
        'date_debut'=>'date',
        'date_fin'=>'date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function typeConge(){
        return $this->belongsTo(TypeConge::class);
    }
}
