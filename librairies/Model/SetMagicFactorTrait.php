<?php

namespace Model;

trait SetMagicFactorTrait
{
    private $magicFactor;

    public function getMagicFactor()
    {
        return $this->magicFactor;
    }

    public function setMagicFactor($magicFactor)
    {
        $this->magicFactor = $magicFactor;
    }
}
