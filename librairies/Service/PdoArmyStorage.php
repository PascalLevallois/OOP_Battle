<?php

namespace Service;

class PdoArmyStorage implements ArmyStorageInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAllArmysData()
    {
        $statement = $this->pdo->prepare('SELECT * FROM army');
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchSingleArmyData($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM army WHERE id = :id');
        $statement->execute(array('id' => $id));
        $armyArray = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$armyArray) {
            return null;
        }

        return $armyArray;
    }
}
