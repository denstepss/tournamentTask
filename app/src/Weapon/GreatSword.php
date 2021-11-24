<?php

declare(strict_types=1);

namespace Tournament\Weapon;

class GreatSword extends Weapon
{
    private const DAMAGE = 12;
    private const INITIAL_ATTACK_CHARGE = 2;
    private int $attackCharge;

    public function __construct()
    {
        $this->damage = self::DAMAGE;
        $this->attackCharge = self::INITIAL_ATTACK_CHARGE;
    }

    public function damage(): int
    {
        $damage = 0;
        if ($this->attackCharge > 0) {
            $this->attackCharge--;
            $damage = $this->damage;
        } else {
            $this->attackCharge = self::INITIAL_ATTACK_CHARGE;
        }

        return $damage;
    }
}
