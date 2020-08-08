<?php


namespace Psiko\database;


use Psiko\Entity\FaqEntity;
use Psiko\helper\Notification;

class FAQTable
{
    /**
     * @var MysqlDatabase
     */
    private MysqlDatabase $db;

    public function __construct()
    {
        $this->db = new MysqlDatabase("psiko");

    }

    public function insertNewQuestion(String $question, String $answer, String $language, int $id=null)
    {
        $sql = "INSERT INTO `faq`(`question`, `reponse`, `idRepondeur`, `langue`) VALUES (:question,:reponse,:id,:langue)";
        $value = array(":question" => $question, ":reponse" => $answer, ":id" => $id, ":langue" => $language);
        try {
            $this->db->prepare($sql,$value);
            $return["success"] = Notification::successAddNewQuestion($language);
        }
        catch (\Exception $e)
        {
            $return["error"] = Notification::errorAddNewQuestion($language);
        } finally {
            return $return;
        }
    }

    public  function  getAllQuestionByLanguage($langue)
    {
        $sql = "SELECT *  FROM `faq` WHERE `langue`=:langue";
        $value = array(":langue" => $langue);
        return $this->db->prepare($sql,$value);

    }

    public function deleteQuestion($idFAQ)
    {
        $sql = "DELETE FROM `faq` WHERE `idQuestion`=:idQuestion ;";
        return $this->db->prepare($sql, array(":idQuestion" => $idFAQ));
    }

    public function getQuestionByID($idQuestion)
    {
        $sql = "SELECT * FROM `faq` WHERE `idQuestion`=:idQuestion ;";
        return $this->db->prepare($sql, array(":idQuestion" => $idQuestion));
    }

    public function updateQuestiobn(string $question, string $answer, int $id, string $language, int $idQuestion)
    {
        $prepare = "UPDATE `faq` SET `question`=:question,`reponse`=:reponse,`idRepondeur`=:id,`langue`=:langue WHERE `idQuestion`=:idQuestion;";
        $value = array(":question" => $question, ":reponse" => $answer, ":id" => $id, ":langue" => $language,":idQuestion" => $idQuestion);
        $this->db->prepare($prepare,$value);

    }
}