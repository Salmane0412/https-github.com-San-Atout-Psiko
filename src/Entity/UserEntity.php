<?php

namespace Psiko\Entity;
use  Psiko\helper\Notification;
use DateTime;

class userEntity
{

    private int $id;
    private String $prenom;
    private String $nom;
    private String $email;
    private String $adresse;
    private String $telephone;
    private String $sexe;
    private String $password;
    private \DateTime $dateInscription;
    private \DateTime $birthday;
    private int $ecoleId;
    private String $rang;
    private int $valider;
    private String $photoPicture;

    public function __construct($id,$prenom, $nom, $email, $adresse, $telephone, $sexe, $password, $dateInscription,$birthday,$ecoleId,$rang,$valider,$photoPicture)
    {
        $this->setId($id);
        $this->setNom($prenom);
        $this->setPrenom($nom);
        $this->setEmail($email);
        $this->setAdresse($adresse);
        $this->setTelephone($telephone);
        $this->setSexe($sexe);
        $this->setPassword($password);
        $this->setDateInscription($dateInscription);
        $this->setBirthday($birthday);
        $this->setEcoleId($ecoleId);
        $this->setRang($rang);
        $this->setValider($valider);
        $this->setPhotoPicture($photoPicture);

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getPrenom(): String
    {
        return $this->prenom;
    }

    /**
     * @param String $prenom
     */
    public function setPrenom(String $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return String
     */
    public function getNom(): String
    {
        return $this->nom;
    }

    /**
     * @param String $nom
     */
    public function setNom(String $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return String
     */
    public function getEmail(): String
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(String $email): void
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getAdresse(): String
    {
        return $this->adresse;
    }

    /**
     * @param String $adresse
     */
    public function setAdresse(String $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return String
     */
    public function getTelephone(): String
    {
        return $this->telephone;
    }

    /**
     * @param String $telephone
     */
    public function setTelephone(String $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return String
     */
    public function getSexe(): String
    {
        return $this->sexe;
    }

    /**
     * @param String $sexe
     */
    public function setSexe(String $sexe): void
    {
        $this->sexe = $sexe;
    }

    /**
     * @return String
     */
    public function getPassword(): String
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(String $password): void
    {
        $this->password = $password;
    }

    /**
     * @return DateTime
     */
    public function getDateInscription(): DateTime
    {
        return $this->dateInscription;
    }

    /**
     * @param DateTime $dateInscription
     */
    public function setDateInscription(DateTime $dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return int
     */
    public function getEcoleId(): int
    {
        return $this->ecoleId;
    }

    /**
     * @param int $ecoleId
     */
    public function setEcoleId(int $ecoleId): void
    {
        $this->ecoleId = $ecoleId;
    }

    /**
     * @return String
     */
    public function getRang(): String
    {
        return $this->rang;
    }

    /**
     * @param String $rang
     */
    public function setRang(String $rang): void
    {
        $this->rang = $rang;
    }

    /**
     * @return bool
     */
    public function isValider(): int
    {
        return $this->valider;
    }

    /**
     * @param int $valider
     */
    public function setValider(int $valider): void
    {
        $this->valider = $valider;
    }

    /**
     * @return String
     */
    public function getPhotoPicture(): String
    {
        return $this->photoPicture;
    }

    /**
     * @param String $photoPicture
     */
    public function setPhotoPicture(String $photoPicture): void
    {
        $this->photoPicture = $photoPicture;
    }



}