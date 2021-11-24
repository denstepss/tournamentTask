<?php

declare(strict_types=1);

namespace Tournament\Weapon;

abstract class Weapon
{
    protected int $damage;

    public function damage(): int
    {
        return $this->damage;
    }
}
