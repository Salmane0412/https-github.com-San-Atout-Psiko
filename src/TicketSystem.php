<?php


namespace Psiko;


use Psiko\database\TicketsTable;
use Psiko\database\userTable;
use Psiko\Entity\TicketsEntity;
use Psiko\helper\Helper;
use Psiko\helper\Notification;

class TicketSystem
{
    private String $fichierSupllementaireLink;
    private TicketsTable $db;

    public function __construct()
    {
        $this->db = new TicketsTable();
    }

    public function createATicket($POST, $FILES, $langue)
    {
        $this->fichierSupllementaireLink = "";
        if (!empty($FILES ["fileOne"]["name"]))
        {
            if (!$this->canUpload($FILES["fileOne"],$langue)) return;
        }

        if (!empty($FILES ["fileTwo"]["name"]))
        {
            if (!$this->canUpload($FILES["fileTwo"],$langue)) return;
        }
        if (!empty($FILES ["fileThree"]["name"]))
        {
            if (!$this->canUpload($FILES["fileThree"],$langue)) return;
        }
        $user = $_SESSION["auth"];
        $this->db->insertNewTicket($POST["titre"],$POST["contenue"], $POST["destinataire"], $user->getId(),$this->fichierSupllementaireLink);
        $this->fichierSupllementaireLink = "";
    }

    private function canUpload($File,$langue)
    {
        $tailleMax= 256000;
        $extensionAutoriser = array( 'jpg' , 'jpeg' , 'gif' , 'png' ,'pdf');
        $extensionFichier = strtolower(substr(strrchr($File['name'], '.'),1));
        if (!in_array($extensionFichier,$extensionAutoriser)){
            $_SESSION["notification"] = Notification::errorExtensionNotSupported($langue);
            return false;
        }
        if ($File["size"] > $tailleMax){
            $depassement = ($File["size"] - $tailleMax)/1000;
            $_SESSION["notification"]["error"] = Notification::errorFileTropLourd($langue,$depassement);
            return false;
        }
        $nomfichier = Helper::chaineAleatoire(20).".".$extensionFichier;
        $cheminFichier ="files-admin-tickets/";
        $chemin = $cheminFichier.$nomfichier;
        $this->fichierSupllementaireLink = $this->fichierSupllementaireLink .$chemin." ";
        $resultat = move_uploaded_file($File['tmp_name'],$chemin);
        if ($resultat) return true;
        $_SESSION["notification"]["error"] = Notification::errorUploadFiles($langue);
        return false;
    }

    public function getAllTicketsByRank($getRang)
    {
        $rank = ($getRang === "administrateur") ? "admin" : "gestionnaire" ;
        if ($rank === "admin")
        {
           $result = $this->db->selectAllAdminTickets();
        }
        else
        {
            $result = $this->db->selectAllGestionnaireTicket();
        }
        $i = 0;
        foreach ($result as $r)
        {
            $return[$i] = new TicketsEntity($r->idTicket,$r->demandeurId,$r->destinataireId, $r->niveauProblem,$r->etatTicket,
                $r->contenue, $r->reponse,$r->Titre, \DateTime::createFromFormat("Y-m-d H:i:s", $r->dateEmission),
                \DateTime::createFromFormat("Y-m-d H:i:s", $r->dateModification),$r->cible,
                $r->fichierSupplementaireLink, $r->isArchive);
            $i++;
        }

        return $return;
    }

    public function changerLevelProblem(array $POST, $ticketId, $langue, $id)
    {
        $this->ajouterReponse($POST["contenue"],$ticketId, $id,$langue);
        $this->db->changeLevelProblem($POST["levelProblem"], $ticketId);
    }

    public function repondreTickets($reponse, $ticketsId, $langue,$idUtilisateur)
    {
        $this->ajouterReponse($reponse,$ticketsId,$idUtilisateur,$langue);
    }

    private function ajouterReponse($texte, $ticketsId,$idUtilisateur,$langue)
    {
        $userDb = new UserSystem();
        $user  = $userDb->getUserById($idUtilisateur);
        $reponse = $this->db->selectTicketByID($ticketsId)->getReponse() ;
        if ($langue === "fr")
        {
           $reponse .= " ##################################################################
                        Réponse ajouter par ".htmlspecialchars($user->getNom())." ".htmlspecialchars($user->getPrenom())."
                        Le : ".date("Y-m-d H:i:s")."
                        ##################################################################\n";
        }
        else if ($langue === "ar")
        {
            $reponse .=  " ##################################################################
            أضاف هذا الجواب".htmlspecialchars($user->getNom())." ".htmlspecialchars($user->getPrenom())."
             ".date("Y-m-d H:i:s")."في: "."
            ##################################################################\n";
        }
        else if ($langue === "pl")
        {
            $reponse .= " ##################################################################
                        Odpowiedz dodaj ".htmlspecialchars($user->getNom())." ".htmlspecialchars($user->getPrenom())."
                        On: ".date("Y-m-d H:i:s")."
                        ##################################################################\n";
        }
        else
        {
            $reponse .= " ##################################################################
                        Answer added by ".$user->getNom()." ".$user->getPrenom()."
                        The : ".date("Y-m-d H:i:s")."
                        ##################################################################\n";
        }
        $reponse .= $texte."\n";
        $this->db->addReponse($reponse,$ticketsId);
    }

    public function rourvrirTicket($ticketId, $adminId,$langue)
    {
        $this->db->rourvrirTicket($ticketId,$adminId);
        if ($langue === "fr")       $reponse = "Ticket rouvert";
        else if ($langue === "ar")  $reponse = "طلب أعيد فتحه ";
        else if ($langue === "pl")  $reponse = "";
        else                        $reponse = "";
        $this->ajouterReponse($reponse,$ticketId,$adminId,$langue);
    }

    public function closeTicketUser($idTickets, $userId,$langue)
    {
        $this->db->closeTicketUser($idTickets);
        if ($langue === "fr")       $reponse = "Fermeture du ticket par l'utilisateur";
        else if ($langue === "ar")  $reponse = "أغلق المستخدم الطلب مجددا";
        else if ($langue === "pl")  $reponse = "";
        else                        $reponse = "";
        $this->ajouterReponse($reponse,$idTickets,$userId,$langue);
    }

    public function closeTicketAdmin($ticketId, $adminId,$langue)
    {
        $this->db->closeTicketAdmin($ticketId,$adminId);
        if ($langue === "fr")       $reponse = "Fermerture du ticket par un administrateur";
        else if ($langue === "ar")  $reponse = "أغلق المدير الطلب مجددا";
        else if ($langue === "pl")  $reponse = "";
        else                        $reponse = "";
        $this->ajouterReponse($reponse,$ticketId,$adminId,$langue);
    }
}