<?php

namespace Model;

class MercenaryArmy extends AbstractArmy
{
    use SetMagicFactorTrait;

    public function getType()
    {
        return 'Mercenary';
    }

    public function isFunctional()
    {
        return true;
    }
}
