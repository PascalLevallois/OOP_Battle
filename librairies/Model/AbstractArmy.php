<?php

namespace Model;

abstract class AbstractArmy
{
    private $id;

    private $name;

    private $weaponPower = 0;

    private $strength = 0;

    /**
     * @return integer
     */
    abstract public function getMagicFactor();

    /**
     * @return string
     */
    abstract public function getType();

    /**
     * @return bool
     */
    abstract public function isFunctional();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setStrength($number)
    {
        if (!is_numeric($number)) {
            throw new \Exception('Invalid strength passed ' . $number);
        }

        $this->strength = $number;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getNameAndSpecif()
    {
        return sprintf(
            '%s -> %s/%s/%s',
            $this->name,
            $this->weaponPower,
            $this->getMagicFactor(),
            $this->strength
        );
    }

    public function doesGivenArmyHaveMoreStrength($army)
    {
        return $army->strength > $this->strength;
    }

    /**
     * @return int
     */
    public function getWeaponPower()
    {
        return $this->weaponPower;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $weaponPower
     */
    public function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
