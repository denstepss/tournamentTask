<?php

declare(strict_types=1);

namespace Tournament\Protection;

use Tournament\Weapon\Axe;
use Tournament\Weapon\Weapon;

class Buckler extends Protection
{
    private int $axeProtection = 3;
    private bool $isEffected = false;
    private bool $isNeedToBeDestroyed = false;

    public function detectDamageProtection(Weapon $weapon, int $damage): int
    {
        $damageProtection = 0;
        if ($damage > 0) {
            if ($this->isEffected) {
                $this->isEffected = false;
                if ($weapon instanceof Axe) {
                    $this->axeProtection -= 1;
                    $this->isNeedToBeDestroyed = 0 === $this->axeProtection;
                }
            } else {
                $damageProtection = $damage;
                $this->isEffected = true;
            }
        }

        return $damageProtection;
    }

    public function isNeedToBeDestroyed(): bool
    {
        return $this->isNeedToBeDestroyed;
    }
}
