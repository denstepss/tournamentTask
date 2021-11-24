<?php

declare(strict_types=1);

namespace Tournament\Weapon;

class WeaponDetector
{
    private const WEAPON_LIST = ['axe', 'sword', 'greatSword'];

    public function isInWeaponList($itemTitle): bool
    {
        return \in_array($itemTitle, self::WEAPON_LIST, true);
    }

    public function detectWeapon($weaponTitle): Weapon
    {
        switch ($weaponTitle) {
            case 'axe':
                $weapon = new Axe();
                break;
            case 'sword':
                $weapon = new Sword();
                break;
            case 'greatSword':
                $weapon = new GreatSword();
                break;
            default:
                throw new \LogicException(\sprintf('%s - Unknown weapon', $weaponTitle));
        }

        return $weapon;
    }
}
