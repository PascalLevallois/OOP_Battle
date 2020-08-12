<?php

namespace Service;

use Model\BattleResult;
use Model\AbstractArmy;

class BattleManager
{
    const TYPE_NORMAL = 'normal';
    const TYPE_NO_MAGICAL_POWERS = 'no_magic';
    const TYPE_ONLY_MAGICAL_POWERS = 'only_magic';

    /**
     * Our fighting algorithm!
     *
     * @return BattleResult
     */
    public function battle(AbstractArmy $army1, $army1Quantity, AbstractArmy $army2, $army2Quantity, $battleType)
    {
        $army1Health = $army1->getStrength() * $army1Quantity;
        $army2Health = $army2->getStrength() * $army2Quantity;

        $army1UsedMagicPowers = false;
        $army2UsedMagicPowers = false;
        $i = 0;
        while ($army1Health > 0 && $army2Health > 0) {

            if ($battleType != self::TYPE_NO_MAGICAL_POWERS && $this->didMageDestroyArmy($army1)) {
                $army2Health = 0;
                $army1UsedMagePowers = true;

                break;
            }
            if ($battleType != self::TYPE_NO_MAGICAL_POWERS && $this->didMageDestroyArmy($army2)) {
                $army1Health = 0;
                $ship2UsedMagePowers = true;

                break;
            }

            if ($battleType != self::TYPE_ONLY_MAGICAL_POWERS) {
                $army1Health = $army1Health - ($army2->getWeaponPower() * $army2Quantity);
                $army2Health = $army2Health - ($army1->getWeaponPower() * $army1Quantity);
            }

            // prevent 2 non-mages army from fighting forever in only_magic mode
            if ($i === 100) {
                $army1Health = 0;
                $army2Health = 0;
            }
            $i++;
        }

        // update the strengths on the armies, so we can show this
        $army1->setStrength($army1Health);
        $army2->setStrength($army2Health);

        if ($army1Health <= 0 && $army2Health <= 0) {
            // they destroyed each other
            $winningArmy = null;
            $losingArmy = null;
            $usedMagicPowers = $army1UsedMagicPowers || $army2UsedMagicPowers;
        } elseif ($army1Health <= 0) {
            $winningArmy = $army2;
            $losingArmy = $army1;
            $usedMagicPowers = $army2UsedMagicPowers;
        } else {
            $winningArmy = $army1;
            $losingArmy = $army2;
            $usedMagicPowers = $army1UsedMagicPowers;
        }

        return new BattleResult($usedMagicPowers, $winningArmy, $losingArmy);
    }

    public static function getAllBattleTypesWithDescriptions()
    {
        return array(
            self::TYPE_NORMAL => 'Normal',
            self::TYPE_NO_MAGICAL_POWERS => 'No Magicals Powers',
            self::TYPE_ONLY_MAGICAL_POWERS => 'Only Magicals Powers'
        );
    }

    private function didMageDestroyArmy(AbstractArmy $army)
    {
        $probability = $army->getMagicFactor() / 100;

        return mt_rand(1, 100) <= ($probability * 100);
    }
}
