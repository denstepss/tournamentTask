<?php

declare(strict_types=1);

namespace Tournament\Contender;

class Highlander extends Contender
{
    private const DEFAULT_WEAPON = 'greatSword';
    private const INITIAL_HIT_POINTS = 150;

    public function __construct($modification = 'Usual')
    {
        parent::__construct($modification);
        $this->hitPoints = self::INITIAL_HIT_POINTS;
        $this->initialHitPoints = self::INITIAL_HIT_POINTS;
        $this->weapon = $this->weaponDetector->detectWeapon(self::DEFAULT_WEAPON);
    }
}
