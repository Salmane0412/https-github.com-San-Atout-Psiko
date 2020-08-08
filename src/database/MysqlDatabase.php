<?php

namespace Psiko\database;

use \PDO;
use Psiko\helper\Helper;

class MysqlDatabase
{
    private $nomDatabase;
    private $utilisateurDatabase;
    private $mdpDatabase;
    private $hostDatabase;
    private static $pdo;

    public function __construct($nomDatabase)
    {

        $init = parse_ini_file("psiko.ini", true);
        $this->nomDatabase = $nomDatabase;
        $this->utilisateurDatabase = Helper::decryptString($init["user"]);
        $this->mdpDatabase = Helper::decryptString($init["mdp"]."==");
        $this->hostDatabase = "junichirokagami";
    }

    public function getPDO(){
        if (self::$pdo == null) {
            $pdo = new \PDO("mysql: host=" . $this->hostDatabase."; dbname=" . $this->nomDatabase,
                $this->utilisateurDatabase, $this->mdpDatabase);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo = $pdo;
        }
        return self::$pdo;
    }

    /**
     * @param $statement
     * @param null $nomClasse
     * @param bool $one
     * @return array|false|mixed|\PDOStatement
     */
    public function query($statement, $nomClasse = null, $one = false){
        $set_rank = $this->getPDO()->exec('SET @rank := 0;');
        $requete = $this->getPDO()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'DELETE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'CREATE') === 0 ||
            strpos($statement, 'DROP TABLE') === 0||
            strpos($statement, 'ALTER TABLE') === 0
        ){
            return $requete;
        }
        if ($nomClasse === null)
        {
            $requete->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $requete->setFetchMode(PDO::FETCH_CLASS, $nomClasse);
        }

        if ($one) {
            $donnees = $requete->fetch();
        } else {
            $donnees =  $requete->fetchAll();
        }
        return $donnees;
    }

    public function prepare($statement,$attributes,$nomClasse = null, $one = false)
    {
        $set_rank = $this->getPDO()->exec('SET @rank := 0;');
        $requete = $this->getPDO()->prepare($statement);
        $reponse = $requete->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'DELETE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'CREATE') === 0 ||
            strpos($statement, 'DROP TABLE') === 0
        ){
            return $reponse;
        }
        if ($nomClasse === null)
        {
            $requete->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $requete->setFetchMode(PDO::FETCH_CLASS, $nomClasse);
        }

        if ($one) {
            $donnees = $requete->fetch();
        } else {
            $donnees =  $requete->fetchAll();
        }
        return $donnees;
    }


}