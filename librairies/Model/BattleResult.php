<?php

namespace Model;

class BattleResult implements \ArrayAccess
{
    private $usedMagicPowers;
    private $winningArmy;
    private $losingArmy;

    /**
     * @param AbstractArmy $winningArmy
     * @param AbstractArmy $losingArmy
     * @param boolean $usedMagicPowers
     */
    public function __construct($usedMagicPowers, AbstractArmy $winningArmy = null, AbstractArmy $losingArmy = null)
    {
        $this->usedMagicPowers = $usedMagicPowers;
        $this->winningArmy = $winningArmy;
        $this->losingArmy = $losingArmy;
    }

    /**
     * @return boolean
     */
    public function isMagicPowersUsed()
    {
        return $this->usedMagicPowers;
    }

    /**
     * @return Army|null
     */
    public function getWinningArmy()
    {
        return $this->winningArmy;
    }

    /**
     * @return Army|null
     */
    public function getLosingArmy()
    {
        return $this->losingArmy;
    }

    /**
     * Winner?
     *
     * @return bool
     */
    public function isThereAWinner()
    {
        return $this->getWinningArmy() !== null;
    }

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}
