<?php

$databaseName = 'poo_battle';
$databaseUser = 'root';
$databasePassword = '';

/*
 * CREATE THE DATABASE
 */
$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS ' . $databaseName);

/*
 * CREATE THE TABLE
 */
$pdo = new PDO('mysql:host=localhost;dbname=' . $databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// initialize the table
$pdo->exec('DROP TABLE IF EXISTS army;');

$pdo->exec('CREATE TABLE `army` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `weapon_power` int(4) NOT NULL,
 `magic_factor` int(4) NOT NULL,
 `strength` int(4) NOT NULL,
 `team` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

/*
 * INSERT SOME DATA!
 */
$pdo->exec('INSERT INTO army
    (name, weapon_power, magic_factor, strength, team) VALUES
    ("Robin Hood", 5, 15, 30, "rebel")');
$pdo->exec('INSERT INTO army
    (name, weapon_power, magic_factor, strength, team) VALUES
    ("Merry Men", 2, 2, 70, "rebel")');
$pdo->exec('INSERT INTO army
    (name, weapon_power, magic_factor, strength, team) VALUES
    ("Sheriff of Nottingham", 70, 0, 500, "sheriff")');
$pdo->exec('INSERT INTO army
    (name, weapon_power, magic_factor, strength, team) VALUES
    ("Army of Nottingham", 4, 4, 50, "sheriff")');
$pdo->exec('INSERT INTO army
    (name, weapon_power, magic_factor, strength, team) VALUES
    ("Saxons", 3, 3, 60, "mercenary")');

echo "Datas insert into database!\n";
