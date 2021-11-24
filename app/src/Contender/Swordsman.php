<?php

declare(strict_types=1);

namespace Tournament\Contender;

class Swordsman extends Contender
{
    private const DEFAULT_WEAPON = 'sword';
    private const INITIAL_HIT_POINTS = 100;

    public function __construct($modification = 'Usual')
    {
        parent::__construct($modification);
        $this->hitPoints = self::INITIAL_HIT_POINTS;
        $this->initialHitPoints = self::INITIAL_HIT_POINTS;
        $this->weapon = $this->weaponDetector->detectWeapon(self::DEFAULT_WEAPON);
    }
}
