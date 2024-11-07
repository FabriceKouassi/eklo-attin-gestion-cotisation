<?php

namespace App\Http\Enums;

class Decisions
{
    const EN_ATTENTE = 0;
    const ACCEPTE = 1;
    const REFUSE = 2;

    /**
     * Recupere tous les roles
     * 
     * @return Array
    */

    public static function all():array
    {
        return [
            self::EN_ATTENTE,
            self::ACCEPTE,
            self::REFUSE,
        ];
    }
}