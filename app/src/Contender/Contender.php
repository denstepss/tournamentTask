<?php

declare(strict_types=1);

namespace Tournament\Contender;

use Tournament\Modification\Modification;
use Tournament\Modification\ModificationDetector;
use Tournament\Protection\Protection;
use Tournament\Protection\ProtectionDetector;
use Tournament\Weapon\Weapon;
use Tournament\Weapon\WeaponDetector;

abstract class Contender
{
    protected int $hitPoints;
    protected int $initialHitPoints;
    protected Weapon $weapon;
    protected WeaponDetector $weaponDetector;
    /**
     * @var Protection[]
     */
    protected array $protection;
    protected ProtectionDetector $protectionDetector;

    protected Modification $modification;
    protected ModificationDetector $modificationDetector;

    public function __construct(string $modification = 'Usual')
    {
        $this->weaponDetector = new WeaponDetector();
        $this->protection = [];
        $this->protectionDetector = new ProtectionDetector();
        $this->modificationDetector = new ModificationDetector();
        $this->modification = $this->modificationDetector->detectModification($modification);
    }

    public function engage(Contender $contender): void
    {
        while ($contender->hitPoints() > 0 && $this->hitPoints() > 0) {
            $contender->setHitPoints($contender->detectHitPoints($this));
            $this->setHitPoints($this->detectHitPoints($contender));
        }
    }

    public function equip(string $equipmentElement): self
    {
        if ($this->weaponDetector->isInWeaponList($equipmentElement)) {
            $this->weapon = $this->weaponDetector->detectWeapon($equipmentElement);
        } else {
            $this->protection[] = $this->protectionDetector->detectProtection($equipmentElement);
        }

        return $this;
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function initialHitPoints(): int
    {
        return $this->initialHitPoints;
    }

    public function weaponDamage(): int
    {
        return $this->weapon->damage();
    }

    public function damage(): int
    {
        return $this->modification->damageLogic($this);
    }

    private function setHitPoints($hitPoints): void
    {
        $this->hitPoints = $hitPoints;
    }

    private function detectHitPoints(Contender $contender): int
    {
        $damage = $this->detetectDamage($contender);
        $hitPoints = $this->hitPoints < $damage ? 0 : $this->hitPoints - $damage;

        return $hitPoints;
    }

    private function detetectDamage(Contender $contender): int
    {
        $damage = 0;
        if ($contender->hitPoints > 0) {
            $contenderDamage = $contender->damage();
            $damageProtection = $this->detectDamageProtection($contender->weapon, $contenderDamage);
            $damageReduction = $this->detectDamageReduction($contender);
            $damage = $contenderDamage - $damageProtection - $damageReduction;
            $damage = $damage > 0 ? $damage : 0;
        }

        return $damage;
    }

    private function detectDamageProtection(Weapon $weapon, $damage): int
    {
        $damageProtection = 0;
        foreach ($this->protection as $protection)
        {
            $damageProtection += $protection->detectDamageProtection($weapon, $damage);
            if ($protection->isNeedToBeDestroyed()) {
                $this->destroyProtection($protection);
            }
        }

        return $damageProtection;
    }

    private function detectDamageReduction(Contender $contender): int
    {
        $damageReduction = 0;
        foreach ($contender->protection as $protection)
        {
            $damageReduction += $protection->detectDamageReduction();
        }

        return $damageReduction;
    }

    private function destroyProtection($protection): void
    {
        if (($key = \array_search($protection, $this->protection)) !== false) {
            unset($this->protection[$key]);
        }
    }
}
