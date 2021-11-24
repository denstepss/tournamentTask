<?php

declare(strict_types=1);

namespace Tournament\Modification;

use Tournament\Contender\Contender;

interface Modification
{
    public function damageLogic(Contender $contender): int;
}
