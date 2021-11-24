<?php

declare(strict_types=1);

namespace Tournament\Protection;

use Tournament\Weapon\Weapon;

class Armor extends Protection
{
    private const REDUCE_DELIVERED_DAMAGE = 1;
    private const REDUCE_RECEIVED_DAMAGE = 3;

    public function detectDamageProtection(Weapon $weapon, int $damage): int
    {
        $damageProtection = $damage > 0 ? self::REDUCE_RECEIVED_DAMAGE : 0;

        return $damageProtection;
    }

    public function detectDamageReduction(): int
    {
        $reduceDamage = self::REDUCE_DELIVERED_DAMAGE;

        return $reduceDamage;
    }
}
