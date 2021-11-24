<?php

declare(strict_types=1);

namespace Tournament\Modification;

use Tournament\Contender\Contender;

class Usual implements Modification
{
    public function damageLogic(Contender $contender): int
    {
        return $contender->weaponDamage();
    }
}
