<?php

class JsonFileArmyStorage
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

    /**
     * @Return Army|null
     */
    public function fetchSingleArmyData($id)
    {
        $armys = $this->fetchAllArmysData();
        foreach ($armys as $army) {
            if ($army['id'] == $id) {
                return $army;
            }
        }

        return null;
    }
}
