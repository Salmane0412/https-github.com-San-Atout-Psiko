<?php


namespace Psiko;


use Psiko\database\FAQTable;
use Psiko\Entity\FaqEntity;
use Psiko\helper\Notification;

class FaqSystem
{
    /**
     * @var FAQTable
     */
    private FAQTable $faqTable;

    public function __construct()
    {
        $this->faqTable = new FAQTable();
    }

    public function newQuestion(array $data)
    {
       return $this->faqTable->insertNewQuestion($data["question"],$data["reponse"],$data["langue"],$data["isAnonyme"]);
    }


    public function getAllQuestionByLangue(String $langue)
    {
        $questions = $this->faqTable->getAllQuestionByLanguage($langue);
        $i = 0;
        $results = array();
        foreach ($questions as $question)
        {
            $i++;

            $results[$i] = new FaqEntity($question->idQuestion, $question->question,$question->reponse,$question->idRepondeur, $question->langue);
        }
        return $results;
    }

    public function supprimerQuestion($idFAQ)
    {
        return $this->faqTable->deleteQuestion($idFAQ);
    }

    public function getQuestionByID($idQuestion)
    {
        $result = $this->faqTable->getQuestionByID($idQuestion);
        if (empty($result))
        {
            return null;
        }else{
            return new FaqEntity(
                $result[0]->idQuestion,
                $result[0]->question,
                $result[0]->reponse,
                $result[0]->idRepondeur,
                $result[0]->langue
            );
        }

    }

    public function updateQuestion(string $question, string $answer, int $id, string $langue,int $idQuestion)
    {
        $r = $this->getQuestionByID($idQuestion);
        if (!is_null($r))
        {
            $this->faqTable->updateQuestiobn($question, $answer, $id, $langue,$idQuestion);
            $result["success"] = Notification::successUpdateFAQ($langue);
        } else {
            $result["error"] = Notification::errorUpdateFAQ($langue);
        }
    }
}