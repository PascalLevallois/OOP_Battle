<?php

namespace Service;

class Container
{
    private $configuration;

    private $pdo;

    private $armyLoader;

    private $battleManager;

    private $armyStorage;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return \PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new \PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return ArmyLoader
     */
    public function getArmyLoader()
    {
        if ($this->armyLoader === null) {
            $this->armyLoader = new ArmyLoader($this->getArmyStorage());
        }

        return $this->armyLoader;
    }

    /**
     * Change for PDO or JSON here !
     * 
     * @return ArmyLoader
     */
    public function getArmyStorage()
    {
        if ($this->armyStorage === null) {
            $this->armyStorage = new PdoArmyStorage($this->getPDO());
            //$this->armyStorage = new JsonFileArmyStorage(__DIR__ . '/../../resources/armys.json');

            // use "composition": put the PdoArmyStorage inside the LogArmyStorage
            $this->armyStorage = new LogArmyStorage($this->armyStorage);
        }

        return $this->armyStorage;
    }

    /**
     * @return BattleManager
     */
    public function getBattleManager()
    {
        if ($this->battleManager === null) {
            $this->battleManager = new BattleManager();
        }

        return $this->battleManager;
    }
}
