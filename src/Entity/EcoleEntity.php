<?php


namespace Psiko\Entity;


class EcoleEntity
{
    private int $ecoleId;
    private String $nom;
    private String $typeEcole;
    private int $adminId;

    /**
     * EcoleEntity constructor.
     * @param int $ecoleId
     * @param String $nom
     * @param String $typeEcole
     * @param int $adminId
     */
    public function __construct(int $ecoleId, string $nom, string $typeEcole, int $adminId)
    {
        $this->ecoleId = $ecoleId;
        $this->nom = $nom;
        $this->typeEcole = $typeEcole;
        $this->adminId = $adminId;
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
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param String $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return String
     */
    public function getTypeEcole(): string
    {
        return $this->typeEcole;
    }

    /**
     * @param String $typeEcole
     */
    public function setTypeEcole(string $typeEcole): void
    {
        $this->typeEcole = $typeEcole;
    }

    /**
     * @return int
     */
    public function getAdminId(): int
    {
        return $this->adminId;
    }

    /**
     * @param int $adminId
     */
    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }


}