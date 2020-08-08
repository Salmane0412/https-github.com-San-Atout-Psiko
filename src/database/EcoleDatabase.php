<?php


namespace Psiko\database;


use Psiko\Entity\EcoleEntity;

class EcoleDatabase
{
    /**
     * @var MysqlDatabase
     */
    private MysqlDatabase $db;

    public function __construct()
    {
        $this->db = new MysqlDatabase("psiko");
    }

    public function getAllEcoles()
    {
        $sql = "SELECT * FROM `ecole`;";
        return $this->db->query($sql);
    }

    public function getEcoleByAdmin($adminEmail)
    {
        $prepare = "SELECT * FROM ecole WHERE ecole.adminId IN (SELECT u.id FROM `user` as u WHERE u.email=:adminEmail)";
        return $this->db->prepare($prepare, array(":adminEmail" => $adminEmail));
    }

    public function addNewEcole($nom, string $ecoleType, $adminId)
    {
        $prepare = "INSERT INTO `ecole`(`nom`, `typeEcole`, `adminId`) VALUES (:nom,:typeEcole,:adminId )";
        $this->db->prepare($prepare, array(":nom" => $nom, ":typeEcole" => $ecoleType, ":adminId" => $adminId));
    }

    public function getEcoleById($ecoleId)
    {
        $prepare = "SELECT * FROM `ecole` WHERE `ecoleId`=:id";
        return $this->db->prepare($prepare,array(":id" => $ecoleId))[0];
    }

    public function modifEcole($nom, string $ecoleType, $adminId, $ecoleId)
    {
        $prepare = "UPDATE `ecole` SET `nom`=:nom,`typeEcole`=:typeEcole,`adminId`=:adminId WHERE `ecoleId`=:ecoleId";
        $this->db->prepare($prepare, array(":nom" => $nom, ":typeEcole" => $ecoleType, ":adminId" => $adminId, ":ecoleId" => $ecoleId));

    }

    public function deleteEcole($ecole)
    {
        $prepare = "DELETE FROM `ecole` WHERE `ecoleId`=:ecoleId;";
        $this->db->prepare($prepare, array(":ecoleId" => $ecole));
    }

    public function getArraysEcoles()
    {
        return $this->db->query("SELECT `ecoleId`, `nom` FROM `ecole`;");
    }
}