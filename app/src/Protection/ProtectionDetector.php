<?php

declare(strict_types=1);

namespace Tournament\Protection;

class ProtectionDetector
{
    public function detectProtection($protectionTitle): Protection
    {
        switch ($protectionTitle) {
            case 'armor':
                $weapon = new Armor();
                break;
            case 'buckler':
                $weapon = new Buckler();
                break;
            default:
                throw new \LogicException(\sprintf('%s - Unknown protection', $protectionTitle));
        }

        return $weapon;
    }
}
