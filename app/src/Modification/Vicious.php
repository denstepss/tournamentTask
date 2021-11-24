<?php

declare(strict_types=1);

namespace Tournament\Modification;

use Tournament\Contender\Contender;

class Vicious implements Modification
{
    private const ADDITIONAL_POISON_DAMAGE = 20;
    private int $usageLimit = 2;

    public function damageLogic(Contender $contender): int
    {
        $damage = $contender->weaponDamage();
        if ($this->usageLimit > 0) {
            $damage += self::ADDITIONAL_POISON_DAMAGE;
            $this->usageLimit -= 1;
        }

        return $damage;
    }
}
