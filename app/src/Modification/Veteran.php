<?php

declare(strict_types=1);

namespace Tournament\Modification;

use Tournament\Contender\Contender;

class Veteran implements Modification
{
    private const BERSERK_DAMAGE_MULTIPLIER = 2;
    private const POINTS_PERCENTAGE_BERSERK = 30;
    private bool $isBerserkActive = false;

    public function damageLogic(Contender $contender): int
    {
        $damage = $contender->weaponDamage();
        if (!$this->isBerserkActive) {
            $this->activateBerserkLogic($contender);
        }
        if ($this->isBerserkActive) {
            $damage *= self::BERSERK_DAMAGE_MULTIPLIER;
        }

        return $damage;
    }

    private function activateBerserkLogic(Contender $contender): void
    {
        $maxBerserkHitPoints = $contender->initialHitPoints() * (self::POINTS_PERCENTAGE_BERSERK / 100);
        if ($maxBerserkHitPoints >= $contender->hitPoints()) {
            $this->isBerserkActive = true;
        }
    }
}
