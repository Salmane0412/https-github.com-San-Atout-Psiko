<?php


namespace Psiko\database;


use Psiko\Entity\userEntity;

class userTable
{

    /**
     * @var MysqlDatabase
     */
    private MysqlDatabase $database;

    public function __construct()
    {
       $this->database = new MysqlDatabase("psiko");
    }

    public function getUserByMail (String $mail)
    {
        $sql = "SELECT * FROM psiko.user WHERE email=:email";
        return $this->database->prepare($sql, array(":email" => $mail));
    }


    public function isUserInDatabase($prenom, $nom, $email)
    {
        $sql = "SELECT * FROM psiko.user WHERE (`nom` = :nom AND `prenom` = :prenom) OR (`email` = :email)";
        return empty($this->database->prepare($sql, array(":prenom" => $prenom, ":nom" => $nom, ":email" => $email)));
    }

    public function insertNewUser(userEntity $user)
    {
        $sql = "INSERT INTO psiko.user (`prenom`, `nom`, `email`, `adresse`, `telephone`, `sexe`, `password`, `dateInscription`, `birthday`, `ecoleId`, `rang`, `valider`, `photoPicture`) 
                       VALUES (:prenom, :nom, :email, :adresse, :telephone, :sexe, :password, :dateInscription, :birthday, :ecoleId, :rang, :valider, :photoPicture)";
        $values = array(
            ":prenom"           => $user->getPrenom(),
            ":nom"              => $user->getNom(),
            ":email"            => $user->getEmail(),
            ":adresse"          => $user->getAdresse(),
            "telephone"         => $user->getTelephone(),
            ":sexe"             => $user->getSexe(),
            ":password"         => $user->getPassword(),
            ":dateInscription"  => $user->getDateInscription()->format('Y-m-d'),
            ":birthday"         => $user->getBirthday()->format('Y-m-d'),
            ":ecoleId"          => $user->getEcoleId(),
            ":rang"             => $user->getRang() ,
            ":valider"          => $user->isValider(),
            ":photoPicture"     => $user->getPhotoPicture()
        );
        $this->database->prepare($sql,$values);

    }

    public function getUserById($id)
    {
        $prepare = "SELECT * FROM psiko.user WHERE `id` = :id";
        return $this->database->prepare($prepare,array(":id"=>$id))[0];
    }

    public function getOldProfilPicture($id)
    {
        $prepare = "SELECT `photoPicture` FROM `user` WHERE `id`=:id;";
        return $this->database->prepare($prepare, array(":id" =>$id))[0]->photoPicture;
    }

    public function changePhotoProfil(string $nomfichier, $id)
    {
        $prepare = "UPDATE `user` SET `photoPicture`=:pf WHERE `id`=:id";
        $this->database->prepare($prepare, array(":pf" => $nomfichier, ":id" => $id));
    }

    public function changeEmail($email, int $id)
    {
        $prepare = "UPDATE `user` SET `email`=:email WHERE `id`=:id";
        $this->database->prepare($prepare, array(":email" => $email, ":id" => $id));
    }

    public function changeSexe($sexe, int $id)
    {
        $prepare = "UPDATE `user` SET `sexe`=:sexe WHERE `id`=:id";
        $this->database->prepare($prepare, array(":sexe" => $sexe, ":id" => $id));
    }

    public function changeAdress($adresse, int $id)
    {
        $prepare = "UPDATE `user` SET `adresse`=:adresse WHERE `id`=:id";
        $this->database->prepare($prepare, array(":adresse" => $adresse, ":id" => $id));
    }

    public function changeMdp(?string $password, int $id)
    {
        $prepare = "UPDATE `user` SET `password`=:password WHERE `id`=:id ";
        $this->database->prepare($prepare, array(":password" => $password, ":id" => $id));
    }

    public function validateUser($id,$isValid)
    {
        $prepare = "UPDATE `user`  SET `valider`=:isValid WHERE `id`=:id";
        $this->database->prepare($prepare, array(":id" => $id,":isValid" => $isValid));
        return;
    }

    public function getAllUser()
    {
        return $this->database->query("SELECT *  FROM `user`;");
    }

    public function changePrenom($prenom, $id)
    {
        $prepare = "UPDATE `user`  SET `prenom`=:prenom WHERE `id`=:id";
        $this->database->prepare($prepare, array(":prenom" => $prenom,":id" => $id));
        return;
    }

    public function changeNom($nom, $id)
    {
        $prepare = "UPDATE `user`  SET `nom`=:nom WHERE `id`=:id";
        $this->database->prepare($prepare, array(":nom" => $nom,":id" => $id));
        return;
    }

    public function changeTelephone($numeroTelephone, $id)
    {
        $prepare = "UPDATE `user`  SET `telephone`=:telephone WHERE `id`=:id";
        $this->database->prepare($prepare, array(":telephone" => $numeroTelephone,":id" => $id));
        return;
    }

    public function changeBirthday( $birthday, $id)
    {
        $prepare = "UPDATE `user`  SET `birthday`=:birthday WHERE `id`=:id";
        $this->database->prepare($prepare, array(":birthday" => $birthday,":id" => $id));
        return;
    }

    public function rechercheMultiple(bool $isMemoCouleur, bool $isReflexeVisuel, bool $isTemp, bool $isFreqCardiaque,bool $isTonalite, $dateDebut, $dateFin, $id)
    {
        $prepare = "SELECT ";
        if ($isMemoCouleur) $prepare .= "`memorisation`,";
        if ($isReflexeVisuel) $prepare .= "`reflexe`,";
        if ($isTemp) $prepare .= "`temperature`,";
        if ($isFreqCardiaque) $prepare .= "`freqCardiaque`,";
        if ($isTonalite) $prepare .= "`tonalite`,";
        if ($dateDebut == $dateFin)
        {
            $dateDebut .= " 00:00:00";
            $dateFin .= " 23:59:59";
        }
        $prepare .= " `dateExamen` FROM `resultat_examen` WHERE `userId`=:id AND (`dateExamen` BETWEEN :dateDebut AND :dateFin);";
        return $this->database->prepare($prepare, array(":id" => $id, ":dateDebut" => $dateDebut,":dateFin" => $dateFin));

    }

    public function rechecheSimple($dateDebut, $dateFin, $id)
    {
        if ($dateDebut == $dateFin)
        {
            $dateDebut .= " 00:00:00";
            $dateFin .= " 23:59:59";
        }
        $prepare = "SELECT `freqCardiaque`,`temperature`,`memorisation`,`reflexe`,`tonalite`,`dateExamen` FROM `resultat_examen` WHERE `userId`=:id AND (`dateExamen` BETWEEN :dateDebut AND :dateFin);";
        return $this->database->prepare($prepare, array(":id" => $id, ":dateDebut" => $dateDebut,":dateFin" => $dateFin));
    }

    public function changeRang($rang, $id)
    {
        $prepare = "UPDATE `user`  SET `rang`=:rang WHERE `id`=:id";
        $this->database->prepare($prepare, array(":rang" => $rang,":id" => $id));
        return;
    }

    public function getAllAdmin()
    {
        return $this->database->query("SELECT `id`, `email` FROM `user` WHERE `rang`= 'administrateur';");
    }

    public function changeEcole($ecoleId, $id)
    {
        $prepare = "UPDATE `user`  SET `ecoleId`=:ecoleId WHERE `id`=:id";
        $this->database->prepare($prepare, array(":ecoleId" => $ecoleId,":id" => $id));
        return;
    }

}