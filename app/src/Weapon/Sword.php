<?php

declare(strict_types=1);

namespace Tournament\Weapon;

class Sword extends Weapon
{
    private const DAMAGE = 5;

    public function __construct()
    {
        $this->damage = self::DAMAGE;
    }
}
