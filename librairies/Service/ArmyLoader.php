<?php

namespace Service;

use Model\MercenaryArmy;
use Model\RebelArmy;
use Model\SheriffArmy;
use Model\AbstractArmy;
use Model\ArmyCollection;

class ArmyLoader
{
    private $armyStorage;

    public function __construct(ArmyStorageInterface $armyStorage)
    {
        $this->armyStorage = $armyStorage;
    }

    /**
     * @return ArmyCollection
     */
    public function getArmys()
    {
        $armys = array();

        $armysData = $this->queryForArmys();

        foreach ($armysData as $armyData) {
            $armys[] = $this->createArmyFromData($armyData);
        }


        return new ArmyCollection($armys);
    }

    /**
     * @param $id
     * @return AbstractArmy
     */
    public function findOneById($id)
    {
        $armyArray = $this->armyStorage->fetchSingleArmyData($id);

        return $this->createArmyFromData($armyArray);
    }

    private function createArmyFromData(array $armyData)
    {
        switch ($armyData['team']) {
            case 'rebel':
                $army = new RebelArmy($armyData['name']);
                break;
            case 'sheriff':
                $army = new SheriffArmy($armyData['name']);
                $army->setMagicFactor($armyData['magic_factor']);
            case 'mercenary':
                $army = new MercenaryArmy($armyData['name']);
                break;
        }

        $army->setId($armyData['id']);
        $army->setWeaponPower($armyData['weapon_power']);
        $army->setStrength($armyData['strength']);

        return $army;
    }

    private function queryForArmys()
    {
        try {
            return $this->armyStorage->fetchAllArmysData();
        } catch (\PDOException $e) {
            trigger_error('Database Exception! ' . $e->getMessage());
            return [];
        }
    }
}
