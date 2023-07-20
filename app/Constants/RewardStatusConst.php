<?php

namespace App\Constants;

class RewardStatusConst
{
    const INITIAL = 0;
    const KREDIT = 100;
    const DEBIT = 200;

    const STATUS_LABEL = [
        self::INITIAL => 'Initial',
        self::KREDIT => 'Kredit',
        self::DEBIT => 'Debit',
    ];   
}
