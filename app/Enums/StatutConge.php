<?php

namespace App\Enums;

enum StatutConge: string
{
    case EnAttente = 'en_attente';
    case Valide    = 'valide';
    case Refuse    = 'refuse';

    public function label(): string
    {
        return match($this) {
            self::EnAttente => 'En attente',
            self::Valide    => 'Validé',
            self::Refuse    => 'Refusé',
        };
    }
}
