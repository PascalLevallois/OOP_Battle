<?php

namespace Model;

class DestroyArmy extends AbstractArmy
{
    public function getMagicFactor()
    {
        return 0;
    }

    public function getType()
    {
        return 'Destroy';
    }

    public function isFunctional()
    {
        return false;
    }
}
