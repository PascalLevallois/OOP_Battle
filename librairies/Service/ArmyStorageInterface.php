<?php

namespace Service;

interface ArmyStorageInterface
{
    /**
     * @return array
     */
    public function fetchAllArmysData();

    /**
     * Returns the single army array
     *
     * @param integer $id
     * @return array
     */
    public function fetchSingleArmyData($id);
}
