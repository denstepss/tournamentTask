<?php

declare(strict_types=1);

namespace Tournament\Modification;

class ModificationDetector
{
    public function detectModification($modificationTitle): Modification
    {
        switch ($modificationTitle) {
            case 'Vicious':
                $modification = new Vicious();
                break;
            case 'Veteran':
                $modification = new Veteran();
                break;
            case 'Usual':
                $modification = new Usual();
                break;
            default:
                throw new \LogicException(\sprintf('%s - Unknown modification', $modificationTitle));
        }

        return $modification;
    }
}
