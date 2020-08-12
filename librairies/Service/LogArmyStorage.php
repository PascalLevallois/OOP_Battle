<?php

namespace Service;

class LogArmyStorage implements ArmyStorageInterface
{
    private $armyStorage;

    public function __construct(ArmyStorageInterface $armyStorage)
    {
        $this->armyStorage = $armyStorage;
    }

    public function fetchAllArmysData()
    {
        $armys =  $this->armyStorage->fetchAllArmysData();

        $this->log(sprintf('Logger:<br>Just fetched %s armies', count($armys)));

        return $armys;
    }

    public function fetchSingleArmyData($id)
    {
        return $this->armyStorage->fetchSingleArmyData($id);
    }

    private function log($message)
    {
        echo $message;
    }
}
