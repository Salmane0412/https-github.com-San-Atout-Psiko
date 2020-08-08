<?php


namespace Psiko\Entity;


class FaqEntity
{
    private int $id;
    private String $question;
    private String $reponse;
    private int $idReponder;
    private String $langue;

    /**
     * FaqEntity constructor.
     * @param int $id
     * @param String $question
     * @param String $reponse
     * @param int $idReponder
     * @param String $langue
     */
    public function __construct(int $id, String $question, String $reponse, int $idReponder, String $langue)
    {
        $this->id = $id;
        $this->question = $question;
        $this->reponse = $reponse;
        $this->idReponder = $idReponder;
        $this->langue = $langue;
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
    public function getQuestion(): String
    {
        return $this->question;
    }

    /**
     * @param String $question
     */
    public function setQuestion(String $question): void
    {
        $this->question = $question;
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
     * @return int
     */
    public function getIdReponder(): int
    {
        return $this->idReponder;
    }

    /**
     * @param int $idReponder
     */
    public function setIdReponder(int $idReponder): void
    {
        $this->idReponder = $idReponder;
    }

    /**
     * @return String
     */
    public function getLangue(): String
    {
        return $this->langue;
    }

    /**
     * @param String $langue
     */
    public function setLangue(String $langue): void
    {
        $this->langue = $langue;
    }




}