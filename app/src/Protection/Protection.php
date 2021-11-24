<?php

declare(strict_types=1);

namespace Tournament\Protection;

use Tournament\Weapon\Weapon;

abstract class Protection
{
    abstract public function detectDamageProtection(Weapon $weapon, int $damage): int;

    public function detectDamageReduction(): int
    {
        return 0;
    }

    public function isNeedToBeDestroyed(): bool
    {
        return false;
    }
}
