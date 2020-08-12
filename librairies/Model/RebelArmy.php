<?php

namespace Model;

class RebelArmy extends AbstractArmy
{
    use SetMagicFactorTrait;

    public function getType()
    {
        return 'Rebel';
    }

    public function isFunctional()
    {
        return true;
    }

    public function getNameAndSpecif($useShortFormat = false)
    {
        $val = parent::getNameAndSpecif($useShortFormat);
        $val .= ' (Robin)';

        return $val;
    }

    public function getMagicFactor()
    {
        return rand(10, 30);
    }
}
