<?php


namespace Psiko\Entity;


class TestEntity
{
    private int $id;
    private int $userId	;
    private int $gestionnaireId;
    private \DateTime $dateExamen;
    private float $freqCardiaque;
    private float $temperature;
    private float $memorisation;
    private float $reflexe;
    private float $tonalite	;
    private String $boitierId;

    /**
     * TestEntity constructor.
     * @param int $id
     * @param int $userId
     * @param int $gestionnaireId
     * @param String $dateExamen
     * @param float $freqCardiaque
     * @param float $temperature
     * @param float $memorisation
     * @param float $reflexe
     * @param float $tonalite
     * @param String $boitierId
     * @throws \Exception
     */
    public function __construct(int $id, int $userId, int $gestionnaireId, String $dateExamen, float $freqCardiaque, float $temperature, float $memorisation, float $reflexe, float $tonalite, String $boitierId)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->gestionnaireId = $gestionnaireId;
        $this->dateExamen = new \DateTime( $dateExamen);
        $this->freqCardiaque = $freqCardiaque;
        $this->temperature = $temperature;
        $this->memorisation = $memorisation;
        $this->reflexe = $reflexe;
        $this->tonalite = $tonalite;
        $this->boitierId = $boitierId;
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getGestionnaireId(): int
    {
        return $this->gestionnaireId;
    }

    /**
     * @param int $gestionnaireId
     */
    public function setGestionnaireId(int $gestionnaireId): void
    {
        $this->gestionnaireId = $gestionnaireId;
    }

    /**
     * @return \DateTime
     */
    public function getDateExamen(): \DateTime
    {
        return $this->dateExamen;
    }

    /**
     * @param \DateTime $dateExamen
     */
    public function setDateExamen(\DateTime $dateExamen): void
    {
        $this->dateExamen = $dateExamen;
    }

    /**
     * @return float
     */
    public function getFreqCardiaque(): float
    {
        return $this->freqCardiaque;
    }

    /**
     * @param float $freqCardiaque
     */
    public function setFreqCardiaque(float $freqCardiaque): void
    {
        $this->freqCardiaque = $freqCardiaque;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return float
     */
    public function getMemorisation(): float
    {
        return $this->memorisation;
    }

    /**
     * @param float $memorisation
     */
    public function setMemorisation(float $memorisation): void
    {
        $this->memorisation = $memorisation;
    }

    /**
     * @return float
     */
    public function getReflexe(): float
    {
        return $this->reflexe;
    }

    /**
     * @param float $reflexe
     */
    public function setReflexe(float $reflexe): void
    {
        $this->reflexe = $reflexe;
    }

    /**
     * @return float
     */
    public function getTonalite(): float
    {
        return $this->tonalite;
    }

    /**
     * @param float $tonalite
     */
    public function setTonalite(float $tonalite): void
    {
        $this->tonalite = $tonalite;
    }

    /**
     * @return String
     */
    public function getBoitierId(): String
    {
        return $this->boitierId;
    }

    /**
     * @param String $boitierId
     */
    public function setBoitierId(String $boitierId): void
    {
        $this->boitierId = $boitierId;
    }


}