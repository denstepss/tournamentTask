<?php

declare(strict_types=1);

namespace Tournament\Weapon;

class Axe extends Weapon
{
    private const DAMAGE = 6;

    public function __construct()
    {
        $this->damage = self::DAMAGE;
    }
}
