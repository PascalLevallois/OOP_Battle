<?php

namespace Service;

class JsonFileArmyStorage implements ArmyStorageInterface
{
    private $filename;

    public function __construct($jsonFilePath)
    {
        $this->filename = $jsonFilePath;
    }

    public function fetchAllArmysData()
    {
        $jsonContents = file_get_contents($this->filename);

        return json_decode($jsonContents, true);
    }

    public function fetchSingleArmyData($id)
    {
        $armys = $this->fetchAllArmysData();

        foreach ($armys as $armys) {
            if ($army['id'] == $id) {
                return $army;
            }
        }

        return null;
    }
}
