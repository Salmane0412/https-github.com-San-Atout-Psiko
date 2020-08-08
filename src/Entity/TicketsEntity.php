<?php


namespace Psiko\Entity;


class TicketsEntity
{
    private int $idTicket;
    private int $demandeurId;
    private int $destinataireId;
    private String $niveauProblem;
    private String $etatTicket;
    private String $contenue;
    private String $reponse;
    private \DateTime $dateEmission;
    private \DateTime $dateModification;
    private String $cible;
    private String $fichierSupllementaireLink;
    private bool $isArchive;
    private String $titre;

    /**
     * TicketsEntity constructor.
     * @param int $idTicket
     * @param int $demandeurId
     * @param int $destinataireId
     * @param String $niveauProblem
     * @param String $etatTicket
     * @param String $contenue
     * @param String $reponse
     * @param String $titre
     * @param \DateTime $dateEmission
     * @param \DateTime $dateCloture
     * @param String $cible
     * @param String $fichierSupllementaireLink
     * @param bool $isArchive
     */
    public function __construct(int $idTicket, int $demandeurId, int $destinataireId, String $niveauProblem,
                                String $etatTicket, String $contenue, String $reponse,String $titre, \DateTime $dateEmission,
                                \DateTime$dateCloture, String $cible, String $fichierSupllementaireLink, bool $isArchive)
    {
        $this->titre = $titre;
        $this->idTicket = $idTicket;
        $this->demandeurId = $demandeurId;
        $this->destinataireId = is_null($destinataireId) ? -1 : $destinataireId ;
        $this->niveauProblem = $niveauProblem;
        $this->etatTicket = $etatTicket;
        $this->contenue = $contenue;
        $this->reponse = is_null($reponse) ? "" : $reponse;
        $this->dateEmission =  $dateEmission;
        $this->dateModification = $dateCloture;
        $this->cible = $cible;
        $this->fichierSupllementaireLink = $fichierSupllementaireLink;
        $this->isArchive = $isArchive;
    }

    public function formatContenue()
    {
        return str_ireplace("\n","<br>",$this->getContenue());
    }

    public function formatResponse()
    {
        return str_ireplace("\n","<br>",$this->getReponse());
    }

    /**
     * @return int
     */
    public function getIdTicket(): int
    {
        return $this->idTicket;
    }

    /**
     * @param int $idTicket
     */
    public function setIdTicket(int $idTicket): void
    {
        $this->idTicket = $idTicket;
    }

    /**
     * @return int
     */
    public function getDemandeurId(): int
    {
        return $this->demandeurId;
    }

    /**
     * @param int $demandeurId
     */
    public function setDemandeurId(int $demandeurId): void
    {
        $this->demandeurId = $demandeurId;
    }

    /**
     * @return int
     */
    public function getDestinataireId(): int
    {
        return $this->destinataireId;
    }

    /**
     * @param int $destinataireId
     */
    public function setDestinataireId(int $destinataireId): void
    {
        $this->destinataireId = $destinataireId;
    }

    /**
     * @return String
     */
    public function getNiveauProblem(): String
    {
        return $this->niveauProblem;
    }

    /**
     * @param String $niveauProblem
     */
    public function setNiveauProblem(String $niveauProblem): void
    {
        $this->niveauProblem = $niveauProblem;
    }

    /**
     * @return String
     */
    public function getEtatTicket(): String
    {
        return $this->etatTicket;
    }

    /**
     * @param String $etatTicket
     */
    public function setEtatTicket(String $etatTicket): void
    {
        $this->etatTicket = $etatTicket;
    }

    /**
     * @return String
     */
    public function getContenue(): String
    {
        return $this->contenue;
    }

    /**
     * @param String $contenue
     */
    public function setContenue(String $contenue): void
    {
        $this->contenue = $contenue;
    }

    /**
     * @return String
     */
    public function getReponse(): String
    {
        return $this->reponse;
    }

    /**
     * @param String $reponse
     */
    public function setReponse(String $reponse): void
    {
        $this->reponse = $reponse;
    }

    /**
     * @return \DateTime
     */
    public function getDateEmission(): \DateTime
    {
        return $this->dateEmission;
    }

    /**
     * @param \DateTime $dateEmission
     */
    public function setDateEmission(\DateTime $dateEmission): void
    {
        $this->dateEmission = $dateEmission;
    }

    /**
     * @return \DateTime
     */
    public function getDateModification(): \DateTime
    {
        return $this->dateModification;
    }

    /**
     * @param \DateTime $dateModification
     */
    public function setDateModification(\DateTime $dateModification): void
    {
        $this->dateModification = $dateModification;
    }



    /**
     * @return String
     */
    public function getCible(): String
    {
        return $this->cible;
    }

    /**
     * @param String $cible
     */
    public function setCible(String $cible): void
    {
        $this->cible = $cible;
    }

    /**
     * @return String
     */
    public function getFichierSupllementaireLink(): String
    {
        return $this->fichierSupllementaireLink;
    }

    /**
     * @param String $fichierSupllementaireLink
     */
    public function setFichierSupllementaireLink(String $fichierSupllementaireLink): void
    {
        $this->fichierSupllementaireLink = $fichierSupllementaireLink;
    }

    /**
     * @return bool
     */
    public function isArchive(): bool
    {
        return $this->isArchive;
    }

    /**
     * @param bool $isArchive
     */
    public function setIsArchive(bool $isArchive): void
    {
        $this->isArchive = $isArchive;
    }

    /**
     * @return String
     */
    public function getTitre(): String
    {
        return $this->titre;
    }

    /**
     * @param String $titre
     */
    public function setTitre(String $titre): void
    {
        $this->titre = $titre;
    }



}