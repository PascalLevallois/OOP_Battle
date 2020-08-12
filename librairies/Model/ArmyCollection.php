<?php

namespace Model;

class ArmyCollection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var AbstractArmy[]
     */
    private $armys;

    public function __construct(array $armys)
    {
        $this->armys = $armys;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->armys);
    }

    public function offsetGet($offset)
    {
        return $this->armys[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->armys[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->armys[$offset]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->armys);
    }

    public function removeAllDestroyArmys()
    {
        foreach ($this->armys as $key => $army) {
            if (!$army->isFunctional()) {
                unset($this->army[$key]);
            }
        }
    }
}
