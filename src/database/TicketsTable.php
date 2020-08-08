<?php


namespace Psiko\database;


use Psiko\Entity\TicketsEntity;

class TicketsTable
{
    private MysqlDatabase $db;

    /**
     * TicketsTable constructor.
     * @param MysqlDatabase $db
     */
    public function __construct()
    {
        $this->db = new MysqlDatabase("psiko");
    }

    public function selectAllMyTickets($id)
    {

        $prepare = " SELECT * FROM `ticket` WHERE demandeurId=:demandeur ORDER BY `dateEmission`";
        $results = $this->db->prepare($prepare,array(":demandeur" => $id) );
        $return = array();

        for ( $i=0; $i < sizeof($results); $i++)
        {
            $return[$i] = new TicketsEntity($results[$i]->idTicket,$results[$i]->demandeurId,$results[$i]->destinataireId,
                            $results[$i]->niveauProblem,$results[$i]->etatTicket,$results[$i]->contenue,
                            $results[$i]->reponse,$results[$i]->Titre,
                            \DateTime::createFromFormat("Y-m-d H:i:s", $results[$i]->dateEmission),
                            \DateTime::createFromFormat("Y-m-d H:i:s", $results[$i]->dateModification),$results[$i]->cible,
                            $results[$i]->fichierSupplementaireLink, $results[$i]->isArchive);
        }
        return $return;
    }

    public function insertNewTicket($titre, $contenue, $cible, $demandeurId, $fileSupplementaire)
    {
        $prepare = "INSERT INTO `ticket`(`demandeurId`, `contenue`, `Titre`,`dateEmission`, `cible`, `fichierSupplementaireLink`)
                    VALUES(:demandeurId, :contenue, :titre ,:dateEmission, :cible, :fichier)";
        $values = array(
            "demandeurId"   => $demandeurId,
            ":contenue"     => $contenue,
            ":titre"        => $titre,
            ":dateEmission" => date("Y-m-d H:i:s"),
            ":cible"        => $cible,
            ":fichier"      => $fileSupplementaire
        ) ;
        $this->db->prepare($prepare, $values);
    }

    public function selectTicketByID($ticketId)
    {
        $prepare = "SELECT * FROM `ticket` WHERE `idTicket`=:id";
        $results = $this->db->prepare($prepare,array(":id" => $ticketId))[0];
        $return = new TicketsEntity($results->idTicket,$results->demandeurId,$results->destinataireId,
            $results->niveauProblem,$results->etatTicket,$results->contenue,
            $results->reponse,$results->Titre,
            \DateTime::createFromFormat("Y-m-d H:i:s", $results->dateEmission),
            \DateTime::createFromFormat("Y-m-d H:i:s", $results->dateModification),$results->cible,
            $results->fichierSupplementaireLink, $results->isArchive);
        return $return;
    }

    public function closeTicketUser($idTickets)
    {
        $prepare = "UPDATE `ticket` 
                    SET `etatTicket`=:newEtat, `dateModification`=:newDate,`isArchive`=1 WHERE `idTicket`=:id";
        $this->db->prepare($prepare, array(":id" => $idTickets,":newEtat" => "Cloturé par l'Utilisateur",":newDate" => date("Y-m-d H:i:s")));
        return;
    }

    public function closeTicketAdmin($idTickets,$adminId)
    {
        $prepare = "UPDATE `ticket` 
                    SET `etatTicket`=:newEtat, `dateModification`=:newDate,`isArchive`=1, `destinataireId`=:adminId WHERE `idTicket`=:id";
        $this->db->prepare($prepare,
            array(":id" => $idTickets,":newEtat" => "Cloturé par l'admin",":newDate" => date("Y-m-d H:i:s"),":adminId" => $adminId)
        );
        return;
    }

    public function selectAllAdminTickets()
    {
        return $this->db->query("SELECT * FROM `ticket`WHERE `cible`='admin'  ");
    }

    public function selectAllGestionnaireTicket()
    {
        return $this->db->query("SELECT * FROM `ticket`WHERE `cible`='gestionnaire' ");
    }

    public function rourvrirTicket($ticketId, $adminId)
    {
        $prepare = "UPDATE `ticket` 
                    SET `etatTicket`=:newEtat, `dateModification`=:newDate,`isArchive`=0, `destinataireId`=:adminId WHERE `idTicket`=:id";
        $this->db->prepare($prepare,
            array(":id" => $ticketId,":newEtat" => "Réouvert par l'admin",":newDate" => date("Y-m-d H:i:s"),":adminId" => $adminId)
        );
        return;
    }

    public function addReponse($text, $id)
    {
        $prepare = "UPDATE `ticket` SET `reponse`=:reponse WHERE `idTicket`=:id";
        $this->db->prepare($prepare,array(":reponse" => $text, ":id" => $id));
    }

    public function updateFileLink(string $fichierSupllementaireLink, $ticketsId)
    {
        $prepare = "UPDATE `ticket` SET `fichierSupplementaireLink`=:link, `dateModification`=:dateModif WHERE `idTicket`=:id";
        $this->db->prepare($prepare,array(":link" => $fichierSupllementaireLink, ":id" => $ticketsId, ":dateModif" => date("Y-m-d H:i:s")));
    }

    public function changeLevelProblem($levelProblem, $ticketId)
    {
        $prepare = "UPDATE `ticket` SET `niveauProblem`=:newLevel, `dateModification`=:dateModif WHERE `idTicket`=:id";
        $this->db->prepare($prepare,array(":newLevel" => $levelProblem, ":id" => $ticketId, ":dateModif" => date("Y-m-d H:i:s")));
    }



}