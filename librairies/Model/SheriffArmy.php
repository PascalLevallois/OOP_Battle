<?php

namespace Model;

class SheriffArmy extends AbstractArmy
{
    use SetMagicFactorTrait;

    private $underHeal;

    public function __construct($name)
    {
        parent::__construct($name);

        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function getNameAndSpecif($useShortFormat = false)
    {
        $val = parent::getNameAndSpecif($useShortFormat);
        $val .= ' (Sheriff)';

        return $val;
    }

    public function isFunctional()
    {
        return !$this->underHeal;
    }

    public function getType()
    {
        return 'Sheriff';
    }
}
