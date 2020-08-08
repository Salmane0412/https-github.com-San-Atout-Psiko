<?php


namespace Psiko;


use Psiko\database\EcoleDatabase;
use Psiko\Entity\EcoleEntity;
use Psiko\helper\Notification;

class EcolesSystemes
{

    private EcoleDatabase $db;

    /**
     * EcolesSystemes constructor.
     */
    public function __construct()
    {
        $this->db = new EcoleDatabase();
    }

    public function getAllEcoles(String $langue)
    {
        $result = $this->db->getAllEcoles();
        $allEcoles = array();
        foreach ($result as $ecole)
        {
            $allEcoles[$ecole->ecoleId] = new EcoleEntity($ecole->ecoleId, $ecole->nom,$ecole->typeEcole, $ecole->adminId);
        }
        return $allEcoles;
    }

    public function getByAdminMail($adminEmail)
    {
        $result = $this->db->getEcoleByAdmin($adminEmail);
        $ecoles = array();
        foreach ($result as $ecole)
        {
            $ecoles[$ecole->ecoleId] = new EcoleEntity($ecole->ecoleId, $ecole->nom,$ecole->typeEcole, $ecole->adminId);
        }
        return $ecoles;
    }

    public function ajouterEcoles(array $POST, $langue)
    {
        $userSystem = new UserSystem();
        $result = array();
        $ecoleType = ($POST["ecoleType"] === "AUTOECOLES") ? "AUTOECOLES" : "AVIATION";
        if ($userSystem->getUserById($POST["adminId"])->getRang() == "administrateur")
        {
            $this->db->addNewEcole($POST["nom"], $ecoleType, $POST["adminId"]);
            $result["success"] = Notification::sucessAddNewSchool($langue);
        }else{
            $result["error"] = Notification::errorBasique($langue);
        }
        return $result;
    }

    public function getEcoleById($ecoleId)
    {
        $ecole = $this->db->getEcoleById($ecoleId);
        return new EcoleEntity($ecole->ecoleId, $ecole->nom,$ecole->typeEcole, $ecole->adminId);
    }

    public function modifierEcole(array $POST, $langue, $ecoleId)
    {
        $userSystem = new UserSystem();
        $result = array();
        $ecoleType = ($POST["ecoleType"] === "AUTOECOLES") ? "AUTOECOLES" : "AVIATION";
        if ($userSystem->getUserById($POST["adminId"])->getRang() == "administrateur")
        {
            $this->db->modifEcole($POST["nom"], $ecoleType, $POST["adminId"], $ecoleId);
            $result["success"] = Notification::sucessChangement($langue);
        }else{
            $result["error"] = Notification::errorBasique($langue);
        }
        return $result;
    }

    public function getArraysEcole()
    {
        $result = $this->db->getArraysEcoles();
        $returnArrays = array();
        foreach ($result as $ecole)
        {
            $returnArrays[$ecole->ecoleId] = $ecole->nom;
        }
        return $returnArrays;
    }


}