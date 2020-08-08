<?php


namespace Psiko\database;


use Psiko\Entity\TestEntity;

class testTable
{

    /**
     * @var MysqlDatabase
     */
    private MysqlDatabase $db;

    public function __construct()
    {
        $this->db = new MysqlDatabase("psiko");
    }

    public function getAllResult()
    {
        $prepare = "SELECT * FROM `resultat_examen`";
        $result = $this->db->query($prepare);
        $returnArray = array();
        for ($i =0; $i < sizeof($result); $i++)
        {
            $returnArray[$i] = new TestEntity($result[$i]->id, $result[$i]->userId, $result[$i]->gestionnaireId,
                                              $result[$i]->dateExamen,$result[$i]->freqCardiaque,$result[$i]->temperature,
                                              $result[$i]->memorisation,$result[$i]->reflexe,$result[$i]->tonalite,
                                              $result[$i]->boitierId);
        }
        return $returnArray;
    }

    public function getNbOfTestByUserId()
    {
        $sql = "SELECT `userId`, AVG(`freqCardiaque`) as freqCardiaque, AVG(`temperature`) as temperature, 
                AVG(`memorisation`) as memorisation, AVG(`reflexe`) as reflexe, AVG(`tonalite`) as tonalite, 
                COUNT(1) as nbTest FROM resultat_examen GROUP BY userId";
        return $this->db->query($sql);
    }

    public function setNewTest($userId, $adminId, $date, $freq, $temp, $memo, $reflex, $tonalite, $boitierId)
    {
        $prepare = "INSERT INTO `resultat_examen`(`userId`, `gestionnaireId`, `dateExamen`, `freqCardiaque`, 
            `temperature`, `memorisation`, `reflexe`, `tonalite`, `boitierId`) VALUES (:userId,:adminId,:dateExam,:freq,
            :temp,:memo,:reflex,:tonalite,:boitierId)";
        return $this->db->prepare($prepare, array(":userId"=>$userId, ":adminId"=> $adminId,":dateExam"=>$date,":freq" =>$freq,
            ":temp"=>$temp,":memo"=>$memo,":reflex" => $reflex,":tonalite" => $tonalite,":boitierId" => $boitierId));
    }


}