<?php
namespace Psiko\routeur;
use \AltoRouter;

class Routeur extends \AltoRouter
{
    private $viewpath;
    private $publicpath;
    private $router;
    private $pageName;
    private $app;
    public  $pageData;
    public $langue;

    public function __construct(string $viewpath, string  $publicpath)
    {
        $this->publicpath = "\\" . $publicpath;
        $this->viewpath = $viewpath;
        $this->router = new AltoRouter();
        $this->router->addMatchTypes(array('deleteType' => '[a-zA-Z0-9-_]++'));
    }

    public function get(
        string $url,
        string $view,
        ?string $name = null
    ):self
    {
        try {
            $this->router->map('GET|POST', $url, $view, $name);
        } catch (\Exception $e) {
        }
        return $this;
    }

    public function run():self
    {
        $this->pageName = null;
        $this->langue = explode("/",substr($_SERVER['REQUEST_URI'],1))[0];
        $requestUrl = substr( $_SERVER['REQUEST_URI'], -1) == "/" ? $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'].'/' ;
        $requestUrl = strtolower($requestUrl);
        $match = $this->router->match($requestUrl);
        $view = $match['target'];
        $params = $match['params'];
        if ($view !== null)
        {
            require $this->viewpath . DIRECTORY_SEPARATOR. $view . '.php' ;
        }else{
            $langue404 = $this->wrongLanguage($requestUrl);
            if (isset($langue404))
            {
                require $this->viewpath . DIRECTORY_SEPARATOR . $langue404.'/erreur/404.php';
            }

        }
        $this->pageName = ($match["name"]);
        return $this;
    }

    public function getUrl(string $urlName, ?array $params = array()):string
    {
        return $this->router->generate($urlName, $params);
    }

    public function getAllPageFrançais():self
    {
        $this->pageData = array();
        $this
            ->get('/', 'index','Acceuil base')
            ->get("/fr/","fr/index", "Acceuil fr")
            ->get("/fr/tickets/","fr/utilisateur/ticketSystem/envoyertickets","EnvoyerTicket fr")
            ->get("/fr/tickets/[i:ticketId]/","fr/utilisateur/ticketSystem/ticketIndividuel","TicketIndividuel fr")
            ->get("/fr/tickets/[i:ticketId]/repondre/","fr/utilisateur/ticketSystem/repondreTicket","TicketUserReponse fr")
            ->get("/fr/admin/tickets/[i:ticketId]/","fr/admin/tickets/consulterTickets","TicketAdminIndividuel fr")
            ->get("/fr/admin/tickets/[i:ticketId]/repondre/","fr/admin/tickets/ajouterReponse","TicketAdminReponse fr")
            ->get("/fr/admin/tickets/[i:ticketId]/rouvrir/","fr/admin/tickets/rouvrir","TicketAdminRouvrir fr")
            ->get("/fr/admin/tickets/[i:ticketId]/changer-niveau-probleme/","fr/admin/tickets/changerLevelPb","ChangerLevelPb fr")
            ->get("/fr/tickets/[i:ticketId]/repondre/","fr/utilisateur/ticketSystem/repondreTicket","RepondreTicket fr")
            ->get("/fr/admin/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","fr/admin/tickets/cloturerTicket", "fermerAdmin fr")
            ->get("/fr/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","fr/admin/tickets/fermerUtilisateur", "fermerUtilisateur fr")
            ->get("/fr/mes-tickets/","fr/utilisateur/ticketSystem/mestickets","MesTickets fr")
            /*Partie de l'utilisateur*/
            ->get("/fr/connexion/","fr/utilisateur/connexionSystem/connexion", "Connexion fr")
            ->get("/fr/inscription/","fr/utilisateur/connexionSystem/inscription", "Inscription fr")
            ->get("/fr/utilisateur/profil/","fr/utilisateur/profil", "Profil fr")
            ->get("/fr/utilisateur/resultats/","fr/utilisateur/resultat", "Resultats fr")
            ->get("/fr/deconnexion/","fr/utilisateur/connexionSystem/deconnexion", "Deconnexion fr")
            /*Erreur HTTP*/
            ->get("/fr/404/","fr/erreur/404", "404 fr")
            ->get("/fr/401/","fr/erreur/401", "401 fr")
            /*Partie Generale*/
            ->get("/fr/nous/","fr/general/nous","Nous fr")
            ->get("/fr/mentionlegal/","fr/general/mentionLegal", "mentionLegal fr")
            ->get("/fr/CGU/","fr/general/CGU", "CGU fr")
            ->get("/fr/confidentialite/","fr/general/confidentialite","confidentialite fr")
            ->get("/fr/plan/","fr/general/structureSite","planSite fr")
            ->get("/fr/faq/","/fr/general/FAQ","FAQ fr")
            ->get("/fr/nous-contacter/","/fr/general/contact","NousContacter fr")
            /*Partie de l'administration*/
            ->get("/fr/admin/tickets/","fr/admin/tickets/administrationTicket","AdminTickets fr")
            ->get("/fr/admin/utilisateur/","fr/admin/utilisateurs/consulterUtilisateur","AdminUser fr")
            ->get("/fr/admin/lancer-test/","fr/admin/tests/lancerTest","LancerUnTest fr")
            ->get("/fr/admin/consulterresultat/","fr/admin/tests/consulterResultat","AdminResultat fr")
            /*Administration FAQ*/
            ->get("/fr/admin/faq/","fr/admin/faq/consulterToutesLesQuestions","AdminFAQ fr")
            ->get("/fr/admin/faq/ajouter/","fr/admin/faq/ajouterQuestion","FAQAjouter fr")
            ->get("/fr/admin/faq/[i:questionId]/","fr/admin/faq/consulterUneQuestion","FAQConsulter fr")
            ->get("/fr/admin/faq/[i:questionId]/modifier/","fr/admin/faq/modifQuestion","FAQModif fr")
            ->get("/fr/admin/faq/[i:questionId]/supprimer/[deleteType:idDelete]/","fr/admin/faq/supprimerQuestion", "FAQSupprimer fr")
            /*Description des tests*/
            ->get("/fr/description/frequence-cardiaque/","fr/general/description/testFrequenceCardiaque","frequenceCardiaque fr")
            ->get("/fr/description/memorisation/","fr/general/description/testMemoire","memoire fr")
            ->get("/fr/description/reflexe-auditif/","fr/general/description/testReflexeAuditif","reflexeAuditif fr")
            ->get("/fr/description/reflexe-visuel/","fr/general/description/testReflexeVisuel","reflexeVisuel fr")
            ->get("/fr/description/temperature/","fr/general/description/testTemperature","temperature fr")
            /**Administration utilisateur**/
            ->get("/fr/admin/utilisateur/","fr/admin/utilisateurs/consulterUtilisateur","AdminUser fr")
            ->get("/fr/admin/utilisateur/[i:id]/valider/[deleteType:validerUser]/","fr/admin/utilisateurs/valider","ValidateUser fr")
            ->get("/fr/admin/utilisateur/[i:id]/bannir/[deleteType:bannirUser]/","fr/admin/utilisateurs/bannir","BanUser fr")
            ->get("/fr/admin/utilisateur/[i:id]/","fr/admin/utilisateurs/consulter","consulterProfil fr")
            ->get("/fr/admin/utilisateur/[i:id]/modifier/","fr/admin/utilisateurs/modifier","ModifAdminProfil fr")
            ->get("/fr/resultats/utilisateur/[i:id]/","fr/utilisateur/resultat","ConsulterResultat fr")
            /*Administration des écoles*/
            ->get("/fr/admin/ecoles/","fr/admin/ecoles/ecolesBasique","AdminEcole fr")
            ->get("/fr/admin/ecoles/[i:id]/modifier/","fr/admin/ecoles/modifier","AdminEcoleModif fr")
            ->get("/fr/admin/ecoles/[i:id]/supprimer/[deleteType:deleteEcole]/","fr/admin/ecoles/supprimer","AdminEcoleSuppr fr")
            ->get("/fr/admin/ecoles/ajouter/","fr/admin/ecoles/ajouter", "AdminAjoutEcoles fr ")
        ;

        return $this;
    }

    public function getAllPageAnglais():self
    {
        $this->pageData = array();
        $this
            ->get("/en/","en/index", "Acceuil en")
            ->get("/en/tickets/","en/utilisateur/ticketSystem/envoyertickets","EnvoyerTicket en")
            ->get("/en/tickets/[i:ticketId]/","en/utilisateur/ticketSystem/ticketIndividuel","TicketIndividuel en")
            ->get("/en/tickets/[i:ticketId]/repondre/","en/utilisateur/ticketSystem/repondreTicket","TicketUserReponse en")
            ->get("/en/admin/tickets/[i:ticketId]/","en/admin/tickets/consulterTickets","TicketAdminIndividuel en")
            ->get("/en/admin/tickets/[i:ticketId]/repondre/","en/admin/tickets/ajouterReponse","TicketAdminReponse en")
            ->get("/en/admin/tickets/[i:ticketId]/rouvrir/","en/admin/tickets/rouvrir","TicketAdminRouvrir en")
            ->get("/en/admin/tickets/[i:ticketId]/changer-niveau-probleme/","en/admin/tickets/changerLevelPb","ChangerLevelPb en")
            ->get("/en/tickets/[i:ticketId]/repondre/","en/utilisateur/ticketSystem/repondreTicket","RepondreTicket en")
            ->get("/en/admin/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","en/admin/tickets/cloturerTicket", "fermerAdmin en")
            ->get("/en/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","en/admin/tickets/fermerUtilisateur", "fermerUtilisateur en")
            ->get("/en/mes-tickets/","en/utilisateur/ticketSystem/mestickets","MesTickets en")
            /*Partie de l'utilisateur*/
            ->get("/en/connexion/","en/utilisateur/connexionSystem/connexion", "Connexion en")
            ->get("/en/inscription/","en/utilisateur/connexionSystem/inscription", "Inscription en")
            ->get("/en/utilisateur/profil/","en/utilisateur/profil", "Profil en")
            ->get("/en/utilisateur/resultats/","en/utilisateur/resultat", "Resultats en")
            ->get("/en/deconnexion/","en/utilisateur/connexionSystem/deconnexion", "Deconnexion en")
            /*Erreur HTTP*/
            ->get("/en/404/","en/erreur/404", "404 en")
            ->get("/en/401/","en/erreur/401", "404 en")
            /*Partie Generale*/
            ->get("/en/nous/","en/general/nous","Nous en")
            ->get("/en/mentionlegal/","en/general/mentionLegal", "mentionLegal en")
            ->get("/en/CGU/","en/general/CGU", "CGU en")
            ->get("/en/confidentialite/","en/general/confidentialite","confidentialite en")
            ->get("/en/plan/","en/general/structureSite","planSite en")
            ->get("/en/faq/","/en/general/FAQ","FAQ en")
            ->get("/en/nous-contacter/","/en/general/contact","NousContacter en")
            /*Partie de l'administration*/
            ->get("/en/admin/tickets/","en/admin/tickets/administrationTicket","AdminTickets en")
            ->get("/en/admin/utilisateur/","en/admin/utilisateurs/consulterUtilisateur","AdminUser en")
            ->get("/en/admin/lancer-test/","en/admin/tests/lancerTest","LancerUnTest en")
            ->get("/en/admin/consulterresultat/","en/admin/tests/consulterResultat","AdminResultat en")
            /*Administration FAQ*/
            ->get("/en/admin/faq/","en/admin/faq/consulterToutesLesQuestions","AdminFAQ en")
            ->get("/en/admin/faq/ajouter/","en/admin/faq/ajouterQuestion","FAQAjouter en")
            ->get("/en/admin/faq/[i:questionId]/","en/admin/faq/consulterUneQuestion","FAQConsulter en")
            ->get("/en/admin/faq/[i:questionId]/modifier/","en/admin/faq/modifQuestion","FAQModif en")
            ->get("/en/admin/faq/[i:questionId]/supprimer/[deleteType:idDelete]/","en/admin/faq/supprimerQuestion", "FAQSupprimer en")
            /*Description des tests*/
            ->get("/en/description/frequence-cardiaque/","en/general/description/testFrequenceCardiaque","frequenceCardiaque en")
            ->get("/en/description/memorisation/","en/general/description/testMemoire","memoire en")
            ->get("/en/description/reflexe-auditif/","en/general/description/testReflexeAuditif","reflexeAuditif en")
            ->get("/en/description/reflexe-visuel/","en/general/description/testReflexeVisuel","reflexeVisuel en")
            ->get("/en/description/temperature/","en/general/description/testTemperature","temperature en")
            /**Administration utilisateur**/
            ->get("/en/admin/utilisateur/","en/admin/utilisateurs/consulterUtilisateur","AdminUser en")
            ->get("/en/admin/utilisateur/[i:id]/valider/[deleteType:validerUser]/","en/admin/utilisateurs/valider","ValidateUser en")
            ->get("/en/admin/utilisateur/[i:id]/bannir/[deleteType:bannirUser]/","en/admin/utilisateurs/bannir","BanUser en")
            ->get("/en/admin/utilisateur/[i:id]/","en/admin/utilisateurs/consulter","consulterProfil en")
            ->get("/en/admin/utilisateur/[i:id]/modifier/","en/admin/utilisateurs/modifier","ModifAdminProfil en")
            ->get("/en/resultats/utilisateur/[i:id]/","en/utilisateur/resultat","ConsulterResultat en")
            /*Administration des écoles*/
            ->get("/en/admin/ecoles/","en/admin/ecoles/ecolesBasique","AdminEcole en")
            ->get("/en/admin/ecoles/[i:id]/modifier/","en/admin/ecoles/modifier","AdminEcoleModif en")
            ->get("/en/admin/ecoles/[i:id]/supprimer/[deleteType:deleteEcole]/","en/admin/ecoles/supprimer","AdminEcoleSuppr en")
            ->get("/en/admin/ecoles/ajouter/","en/admin/ecoles/ajouter", "AdminAjoutEcoles en ")
        ;
        return $this;
    }


    public function getAllPagePolonais():self
    {
        $this->pageData = array();
        $this->pageData = array();
        $this->get("/pl/","pl/index", "Acceuil pl")
            ->get("/pl/logowania","pl/utilisateur/login", "Connexion pl")
            ->get("/pl/tickets/","pl/utilisateur/ticketSystem/envoyertickets","EnvoyerTicket pl")
            ->get("/pl/tickets/[i:ticketId]/","pl/utilisateur/ticketSystem/ticketIndividuel","TicketIndividuel pl")
            ->get("/pl/tickets/[i:ticketId]/repondre/","pl/utilisateur/ticketSystem/repondreTicket","TicketUserReponse pl")

            ->get("/pl/admin/tickets/[i:ticketId]/","pl/admin/tickets/consulterTickets","TicketAdminIndividuel pl")
            ->get("/pl/admin/tickets/[i:ticketId]/repondre/","pl/admin/tickets/ajouterReponse","TicketAdminReponse pl")
            ->get("/pl/admin/tickets/[i:ticketId]/rouvrir/","pl/admin/tickets/rouvrir","TicketAdminRouvrir pl")
            ->get("/pl/admin/tickets/[i:ticketId]/changer-niveau-probleme/","pl/admin/tickets/changerLevelPb","ChangerLevelPb pl")
            ->get("/pl/tickets/[i:ticketId]/repondre/","pl/utilisateur/ticketSystem/repondreTicket","RepondreTicket pl")
            ->get("/pl/admin/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","pl/admin/tickets/cloturerTicket", "fermerAdmin pl")
            ->get("/pl/tickets/[i:idTickets]/fermer/[deleteType:idDelete]/","pl/admin/tickets/fermerUtilisateur", "fermerUtilisateur pl")
            ->get("/pl/mes-tickets/","pl/utilisateur/ticketSystem/mestickets","MesTickets pl")
            /*Partie de l'utilisateur*/
            ->get("/pl/connexion/","pl/utilisateur/connexionSystem/connexion", "Connexion pl")
            ->get("/pl/inscription/","pl/utilisateur/connexionSystem/inscription", "Inscription pl")
            ->get("/pl/utilisateur/profil/","pl/utilisateur/profil", "Profil pl")
            ->get("/pl/utilisateur/resultats/","pl/utilisateur/resultat", "Resultats pl")
            ->get("/pl/deconnexion/","pl/utilisateur/connexionSystem/deconnexion", "Deconnexion pl")
            /*Erreur HTTP*/
            ->get("/pl/404/","pl/erreur/404", "404 pl")
            ->get("/pl/401/","pl/erreur/401", "401 pl")
            /*Partie Generale*/
            ->get("/pl/nous/","pl/general/nous","Nous pl")
            ->get("/pl/mentionlegal/","pl/general/mentionLegal", "mentionLegal pl")
            ->get("/pl/CGU/","pl/general/CGU", "CGU pl")
            ->get("/pl/confidentialite/","pl/general/confidentialite","confidentialite pl")
            ->get("/pl/plan/","pl/general/structureSite","planSite pl")
            ->get("/pl/faq/","/pl/general/FAQ","FAQ pl")
            ->get("/pl/nous-contacter/","/pl/general/contact","NousContacter pl")
            /*Partie de l'administration*/
            ->get("/pl/admin/tickets/","pl/admin/tickets/administrationTicket","AdminTickets pl")
            ->get("/pl/admin/utilisateur/","pl/admin/utilisateurs/consulterUtilisateur","AdminUser pl")
            ->get("/pl/admin/lancer-test/","pl/admin/tests/lancerTest","LancerUnTest pl")
            ->get("/pl/admin/consulterresultat/","pl/admin/tests/consulterResultat","AdminResultat pl")
            /*Administration FAQ*/
            ->get("/pl/admin/faq/","pl/admin/faq/consulterToutesLesQuestions","AdminFAQ pl")
            ->get("/pl/admin/faq/ajouter/","pl/admin/faq/ajouterQuestion","FAQAjouter pl")
            ->get("/pl/admin/faq/[i:questionId]/","pl/admin/faq/consulterUneQuestion","FAQConsulter pl")
            ->get("/pl/admin/faq/[i:questionId]/modifier/","pl/admin/faq/modifQuestion","FAQModif pl")
            ->get("/pl/admin/faq/[i:questionId]/supprimer/[deleteType:idDelete]/","pl/admin/faq/supprimerQuestion", "FAQSupprimer pl")
            /*Description des tests*/
            ->get("/pl/description/frequence-cardiaque/","pl/general/description/testFrequenceCardiaque","frequenceCardiaque pl")
            ->get("/pl/description/memorisation/","pl/general/description/testMemoire","memoire pl")
            ->get("/pl/description/reflexe-auditif/","pl/general/description/testReflexeAuditif","reflexeAuditif pl")
            ->get("/pl/description/reflexe-visuel/","pl/general/description/testReflexeVisuel","reflexeVisuel pl")
            ->get("/pl/description/temperature/","pl/general/description/testTemperature","temperature pl")
            /**Administration utilisateur**/
            ->get("/pl/admin/utilisateur/","pl/admin/utilisateurs/consulterUtilisateur","AdminUser pl")
            ->get("/pl/admin/utilisateur/[i:id]/valider/[deleteType:validerUser]/","pl/admin/utilisateurs/valider","ValidateUser pl")
            ->get("/pl/admin/utilisateur/[i:id]/bannir/[deleteType:bannirUser]/","pl/admin/utilisateurs/bannir","BanUser pl")
            ->get("/pl/admin/utilisateur/[i:id]/","pl/admin/utilisateurs/consulter","consulterProfil pl")
            ->get("/pl/admin/utilisateur/[i:id]/modifier/","pl/admin/utilisateurs/modifier","ModifAdminProfil pl")
            ->get("/pl/resultats/utilisateur/[i:id]/","pl/utilisateur/resultat","ConsulterResultat pl")
            /*Administration des écoles  en polonais*/
            ->get("/pl/admin/ecoles/","pl/admin/ecoles/ecolesBasique","AdminEcole pl")
            ->get("/pl/admin/ecoles/[i:id]/modifier/","pl/admin/ecoles/modifier","AdminEcoleModif pl")
            ->get("/pl/admin/ecoles/[i:id]/supprimer/[deleteType:deleteEcole]/","pl/admin/ecoles/supprimer","AdminEcoleSuppr pl")
            ->get("/pl/admin/ecoles/ajouter/","pl/admin/ecoles/ajouter", "AdminAjoutEcoles pl ")
        ;

        return $this;
    }

    public function getAllPageArabe():self
    {
        $this->pageData = array();
        $this
            ->get("/ar/","ar/index", "Acceuil ar")

            ->get("/ar/talabat/","ar/utilisateur/ticketSystem/envoyertickets","EnvoyerTicket ar")
            ->get("/ar/talabat/[i:ticketId]/","ar/utilisateur/ticketSystem/ticketIndividuel","TicketIndividuel ar")
            ->get("/ar/talabat/[i:ticketId]/ajib/","ar/utilisateur/ticketSystem/repondreTicket","TicketUserReponse ar")

            ->get("/ar/modir/talabat/[i:ticketId]/","ar/admin/tickets/consulterTickets","TicketAdminIndividuel ar")
            ->get("/ar/modir/talabat/[i:ticketId]/ajib/","ar/admin/tickets/ajouterReponse","TicketAdminReponse ar")
            ->get("/ar/modir/talabat/[i:ticketId]/iadatfath/","ar/admin/tickets/rouvrir","TicketAdminRouvrir ar")
            ->get("/ar/modir/talabat/[i:ticketId]/tabdil-mostawa-lmochkil/","ar/admin/tickets/changerLevelPb","ChangerLevelPb ar")
            ->get("/ar/talabat/[i:ticketId]/ajib/","ar/utilisateur/ticketSystem/repondreTicket","RepondreTicket ar")
            ->get("/ar/modir/talabat/[i:idtalabat]/aghliq/[deleteType:idDelete]/","ar/admin/tickets/cloturerTicket", "fermerAdmin ar")
            ->get("/ar/talabat/[i:idtalabat]/aghliq/[deleteType:idDelete]/","ar/admin/tickets/fermerUtilisateur", "fermerUtilisateur ar")
            ->get("/ar/talabat-y/","ar/utilisateur/ticketSystem/mestickets","MesTickets ar")
            /*Partie de l'utilisateur*/
            ->get("/ar/tasjildokhol/","ar/utilisateur/connexionSystem/connexion", "Connexion ar")
            ->get("/ar/tasjil/","ar/utilisateur/connexionSystem/inscription", "Inscription ar")
            ->get("/ar/mostakhdim/milafchakhi/","ar/utilisateur/profil", "Profil ar")
            ->get("/ar/mostakhdim/nataij/","ar/utilisateur/resultat", "Resultats ar")
            ->get("/ar/tasjilkhoroj/","ar/utilisateur/connexionSystem/deconnexion", "Deconnexion ar")
            /*Erreur HTTP*/
            ->get("/ar/404/","ar/erreur/404", "404 ar")
            ->get("/ar/401/","ar/erreur/401", "401 ar")
            /*Partie Generale*/
            ->get("/ar/nahno/","ar/general/nous","Nous ar")
            ->get("/ar/ich3arqanoni/","ar/general/mentionLegal", "mentionLegal ar")
            ->get("/ar/CGU/","ar/general/CGU", "CGU ar")
            ->get("/ar/khososia/","ar/general/confidentialite","confidentialite ar")
            ->get("/ar/plan/","ar/general/structureSite","planSite ar")
            ->get("/ar/faq/","/ar/general/FAQ","FAQ ar")
            ->get("/ar/itasil-bina/","/ar/general/contact","NousContacter ar")
            /*Partie de l'administration*/
            ->get("/ar/modir/talabat/","ar/admin/tickets/administrationTicket","AdminTickets ar")
            ->get("/ar/modir/mostakhdim/","ar/admin/utilisateurs/consulterUtilisateur","AdminUser ar")
            ->get("/ar/modir/itlaq-ikhtibar/","ar/admin/tests/lancerTest","LancerUnTest ar")
            ->get("/ar/modir/ziyaratnatija/","ar/admin/tests/consulterResultat","AdminResultat ar")
            /*Administration FAQ*/
            ->get("/ar/modir/faq/","ar/admin/faq/consulterToutesLesQuestions","AdminFAQ ar")
            ->get("/ar/modir/faq/adif/","ar/admin/faq/ajouterQuestion","FAQAjouter ar")
            ->get("/ar/modir/faq/[i:questionId]/","ar/admin/faq/consulterUneQuestion","FAQConsulter ar")
            ->get("/ar/modir/faq/[i:questionId]/tabdil/","ar/admin/faq/modifQuestion","FAQModif ar")
            ->get("/ar/modir/faq/[i:questionId]/hadf/[deleteType:idDelete]/","ar/admin/faq/supprimerQuestion", "FAQSupprimer ar")

            /*desciotions des tests*/
            ->get("/ar/wasf/darabat-Qalb/","ar/general/description/testfrequenceCardiaque","frequenceCardiaque ar")
            ->get("/ar/wasf/tadakor/","ar/general/description/testMemoire","memoire ar")
            ->get("/ar/wasf/redfi3l-sam3i/","ar/general/description/testReflexeAuditif","reflexeAuditif ar")
            ->get("/ar/wasf/redfi3l-mar2i/","ar/general/description/testReflexeVisuel","reflexeVisuel ar")
            ->get("/ar/wasf/harara/","ar/general/description/testTemperature","temperature ar")
            /*Administration utilisateur*/
            ->get("/ar/modir/mostakhdim/","ar/admin/utilisateurs/consulterUtilisateur","AdminUser ar")
            ->get("/ar/modir/mostakhdim/[i:id]/tahaqoq/[deleteType:validerUser]/","ar/admin/utilisateurs/valider","ValidateUser ar")
            ->get("/ar/modir/mostakhdim/[i:id]/izala/[deleteType:bannirUser]/","ar/admin/utilisateurs/bannir","BanUser ar")
            ->get("/ar/modir/mostakhdim/[i:id]/","ar/admin/utilisateurs/consulter","consulterProfil ar")
            ->get("/ar/modir/mostakhdim/[i:id]/tabdil/","ar/admin/utilisateurs/modifier","ModifAdminProfil ar")
            ->get("/ar/Nataij/mostakhdim/[i:id]/","ar/utilisateur/resultat","ConsulterResultat ar")
            /*Admin École*/
            /*Administration des écoles*/
            ->get("/ar/modir/madaris/","ar/admin/ecoles/ecolesBasique","AdminEcole ar")
            ->get("/ar/modir/madaris/[i:id]/idafa/","ar/admin/ecoles/modifier","AdminEcoleModif ar")
            ->get("/ar/modir/madaris/[i:id]/hadf/[deleteType:deleteEcole]/","ar/admin/ecoles/supprimer","AdminEcoleSuppr ar")
            ->get("/ar/modir/madaris/idafa/","ar/admin/ecoles/ajouter", "AdminAjoutEcoles ar")
        ;

        return $this;
    }



    public function getPublicPath()
    {
        return $this->publicpath.DIRECTORY_SEPARATOR;
    }

    private function wrongLanguage($url)
    {
        $langueDispo = ["ar", "fr", "pl", "en"];
        $urlData = explode("/",substr($url,1));
        if (in_array($urlData[0], $langueDispo))
        {
            $urlTest = "";
            for ($i = 1; $i < sizeof($urlData); $i++ )
            {
                $urlTest .= "/".$urlData[$i];
            }
            foreach ($langueDispo as $langue)
            {
                if ($langue !== $urlData[0])
                {
                    $matchTest = $this->router->match("/".$urlTest);
                    if ($matchTest != null)
                    {
                        $this->langue = $langue;
                        header("Location: /".$langue.$urlTest,true, 303);
                        exit();
                    }
                }

            }
            return $urlData[0];
        }
        else
        {
            $this->langue = "en";
            header("Location: /en/langageNotSuported");
            exit();
        }
    }

    public function getPageOtherLanguage()
    {
        $result = array();
        foreach ($this->router->routes as $r)
        {
           if (explode(" ",$r[3])[0] === explode(" ", $this->pageName)[0]) $result[explode(" ",$r[3])[1]] = $this->getUrl($r[3]);
        }
        return $result;
    }

    public function getLangue()
    {
        return $this->langue;
    }
}