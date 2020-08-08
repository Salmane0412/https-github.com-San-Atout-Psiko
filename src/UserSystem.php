<?php


namespace Psiko;


use DateTime;
use Psiko\database\userTable;
use Psiko\Entity\userEntity;
use Psiko\helper\Helper;
use Psiko\helper\Notification;

class UserSystem
{

    private userTable $userDatabase;

    public function __construct()
    {
        $this->userDatabase = new \Psiko\database\userTable();

    }

    public function getUserByEmail($email)
    {
        return $this->userDatabase->getUserByMail($email);
    }

    public function authentification($email, $password, $langue)
    {
        $result = array();

        $user = $this->userDatabase->getUserByMail($email);
        if (!empty($user))
        {
            if (password_verify($password,$user[0]->password) && $user[0]->valider == 1)
            {
                $_SESSION["auth"] = new userEntity($user[0]->id,$user[0]->prenom,$user[0]->nom,$user[0]->email,$user[0]->adresse,$user[0]->telephone,
                    $user[0]->sexe,$user[0]->password,
                    DateTime::createFromFormat("Y-m-d",$user[0]->dateInscription),
                    DateTime::createFromFormat("Y-m-d",$user[0]->birthday),$user[0]->ecoleId,
                    $user[0]->rang,$user[0]->valider,$user[0]->photoPicture);
                $result["success"] = Notification::successLogIn($langue);
            }
            else
            {
                $result["error"] = Notification::errorNotifWrongPassword($langue);
            }
        }
        else
        {
            $result["error"] = Notification::errorNotifUserNotFoubnd($langue);
        }
        return $result;
    }


    public function inscription($POST, $langue)
    {

        $result = array();
        $isNotInDatabase = $this->userDatabase->isUserInDatabase($POST["prenom"], $_POST["nom"], $POST["email"]);
        $isMoreThan16 =  DateTime::createFromFormat("Y-m-d", $POST["birthday"])->diff(new DateTime())->y >= 16 ;
        $isSamePassword = $POST["password"] === $POST["passwordRpt"];
        $isCodePostal = is_int($POST["codePostal"]);
        if ($isSamePassword && $isNotInDatabase && $isMoreThan16 && $isCodePostal)
        {
            $adresse = $POST["adresse"] ." ". $POST["codePostal"];
            $password = password_hash($POST["password"],PASSWORD_BCRYPT); ;
            $user = new userEntity(-1,$POST["prenom"],$POST["nom"],$POST["email"],$adresse,
                $POST["numeroTelephone"],$POST["sexe"],$password,new DateTime(),
                DateTime::createFromFormat("Y-m-d", $POST["birthday"]),1,
                "utilisateur",false,"default.png");
            $this->userDatabase->insertNewUser($user);
        }
        else
        {
            if (!$isSamePassword) $result["error"] = Notification::errorNotifPasswordMissMatch($langue);
            if (!$isNotInDatabase) $result["error"]= Notification::errorNotifAllReadyIn($langue);
            if (!$isMoreThan16) $result["error"] = Notification::errorNotifTooYoung($langue);
        }
        return $result;
    }


    public function deconnexion()
    {
        setcookie('remember',NULL,-1);
        unset($_SESSION['auth']);
        return "Vous avez bien été déconnecté";
    }

    public function getUserById($idUtilisateur)
    {
        $user = $this->userDatabase->getUserById($idUtilisateur);
        return  new userEntity($user->id,$user->prenom,$user->nom,$user->email,$user->adresse,$user->telephone,
            $user->sexe,$user->password,
            DateTime::createFromFormat("Y-m-d",$user->dateInscription),
            DateTime::createFromFormat("Y-m-d",$user->birthday),$user->ecoleId,
            $user->rang,$user->valider,$user->photoPicture);
    }

    public function changeProfilPicture(array $images, $id,string $langue)
    {
        $pseudo = str_ireplace(" ","-",$this->getUserById($id)->getNom())."-".str_ireplace(" ","-",$this->getUserById($id)->getPrenom());
        $tailleMax= 256000;
        $extensionAutoriser = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
        $extensionFichier = strtolower(substr(strrchr($images['name'], '.'),1));
        if (!in_array($extensionFichier,$extensionAutoriser)){
            $sortie["errors"] = "L'extension n'est pas une des extensions supportés";
            return $sortie;
        }
        if ($images["size"] > $tailleMax){
            $depassement = ($images["size"] - $tailleMax)/1000;
            $sortie["danger"] = "Nous sommes désolé mais votre fichier dépasse la limite de ".$depassement. " Ko";
            return $sortie;
        }
        $nomfichier = $pseudo.Helper::chaineAleatoire(20).".".$extensionFichier;
        $cheminImage ="avatar/";
        $chemin = $cheminImage.$nomfichier;
        $resultat = move_uploaded_file($images['tmp_name'],$chemin);
        if ($resultat) {
            if ($this->getUserById($id)->getPhotoPicture() != "default.png")
            {
                $ancienneImage = $this->userDatabase->getOldProfilPicture($id);
                $cheminAncienneImage = $cheminImage.$ancienneImage;
                @unlink($cheminAncienneImage);
            }
            $this->userDatabase->changePhotoProfil($nomfichier,$id);
            $sortie["success"] = "L'image a bien été uploadée";
            return $sortie;
        }
        else{
            $sortie["errors"] = "Nous sommes désolé mais une erreur c'est produite veuillez contacter le webmaster";
            return $sortie;
        }
    }

    public function changeEmail($email, int $getId,$langue)
    {
        if (empty($this->userDatabase->getUserByMail($email)))
        {
            $this->userDatabase->changeEmail($email,$getId);
            $result["success"] =  Notification::successChangeEmail($langue);
        }else{
            $result["error"]  = Notification::errorEmailAllReadyExist($langue);
        }
        return $result;
    }

    public function changeSexe($sexe, int $id, string $langue )
    {
        if ($this->getUserById($id)->getSexe() != $sexe)
        {
            $this->userDatabase->changeSexe($sexe,$id);
            $result["success"] =  Notification::sucessChangement($langue);
        }else{
            $result["warning"]  = Notification::warningSameSexe($langue);
        }
        return $result;
    }

    public function changeAdresse($adresse, int $getId, string $langue)
    {
       $this->userDatabase->changeAdress($adresse,$getId);
       $result["success"] =  Notification::sucessChangement($langue);
       return $result ;
    }

    public function changeMdp(array $POST, int $id, string $langue)
    {
        $user = $this->getUserById($id);
            if (password_verify($POST["oldPassword"],$user->getPassword()))
            {
                $result = $this->changeMdpAdmin($POST["newPassword"],$POST["newPasswordRpt"], $id,$langue);
            }
            else $result["error"] = Notification::errorNotifWrongPassword($langue);
        return $result;
    }

    public function validateUser($id, $langue)
    {
        $this->userDatabase->validateuser($id, 1);
        return Notification::isValide($langue);


    }

    //Modifié par Come
    public function bannirUser($id, $langue)
    {
        $this->userDatabase->validateuser($id, -1);
        return Notification::isBanned($langue);

    }

    public function getAllUser()
    {
        $users = $this->userDatabase->getAllUser();
        $i =0;
        foreach ($users as $user)
        {
            $return[$i] =new userEntity($user->id,$user->prenom,$user->nom,$user->email,$user->adresse,$user->telephone,
                $user->sexe,$user->password,
                DateTime::createFromFormat("Y-m-d",$user->dateInscription),
                DateTime::createFromFormat("Y-m-d",$user->birthday),$user->ecoleId,
                $user->rang,$user->valider,$user->photoPicture);
            $i++;
        }
        return $return;
    }

    public function modificationAdmin($userId, array $POST, $Langue)
    {
        if (!empty($POST["email"])) $_SESSION["notification"] = $this->changeEmail($_POST["email"],$userId,$Langue);
        if (!empty($POST["sexe"])) $_SESSION["notification"] = $this->changeSexe($_POST["sexe"],$userId,$Langue);
        if (!empty($POST["adresse"])) $_SESSION["notification"] = $this->changeAdresse($_POST["adresse"],$userId,$Langue);
        if (!empty($POST["password"]))$_SESSION["notification"] = $this->changeMdpAdmin($POST["password"],$POST["passwordRpt"],$userId,$Langue);
        if (!empty($POST["prenom"]))$_SESSION["notification"] = $this->changePrenom($POST["prenom"],$userId,$Langue);
        if (!empty($POST["nom"]))$_SESSION["notification"] = $this->changeNom($POST["nom"],$userId,$Langue);
        if (!empty($_POST["numeroTelephone"]))$_SESSION["notification"] = $this->changeTelephone($_POST["numeroTelephone"], $userId, $Langue);
        if ($_POST["rang"] != $this->getUserById($userId)->getRang())$_SESSION["notification"] = $this->changeRang($_POST["rang"], $userId, $Langue);
        if ($_POST["ecoleId"] != $this->getUserById($userId)->getEcoleId())$_SESSION["notification"] = $this->changeEcoleId($_POST["ecoleId"], $userId, $Langue);
        if (($_POST["birthday"] != date("Y-m-d")))$_SESSION["notification"] = $this->changeDateNaissance($_POST["birthday"],$userId,$Langue);



    }



    private function changeMdpAdmin($password, $passwordRpt, $userId, $langue)
    {
        if ( $password== $passwordRpt )
        {
            $password = password_hash($password,PASSWORD_BCRYPT);
            $this->userDatabase->changeMdp($password, $userId);
            $result["success"] = Notification::sucessChangementMdp($langue);

        } else $result["error"] = Notification::errorNotifPasswordMissMatch($langue);
        return $result;
    }

    private function changePrenom($prenom, $userId, $langue)
    {
        $this->userDatabase->changePrenom($prenom, $userId);
        $result["success"] = Notification::sucessChangement($langue);
        return $result;
    }

    private function changeNom($prenom, $userId, $langue)
    {
        $this->userDatabase->changeNom($prenom, $userId);
        $result["success"] = Notification::sucessChangement($langue);
        return $result;
    }

    public function changeTelephone($numeroTelephone, $userId, $langue)
    {
        $this->userDatabase->changeTelephone($numeroTelephone, $userId);
        $result["success"] = Notification::sucessChangement($langue);
        return $result;
    }

    private function changeDateNaissance($birthday, $id, $langue)
    {
        $this->userDatabase->changeBirthday($birthday,$id);
        $result["success"] = Notification::sucessChangement($langue);
        return $result;
    }

    public function rechercheAdmin(array $POST, string $langue,$id)
    {

        $isFreqCardiaque = isset($POST['freqCardiaque']) ;
        $isTemp = isset($POST['tempPeau']);
        $isReflexeVisuel = isset($POST['reflexeVisuel']) ;
        $isRecoTonalite = isset($POST['recoTonalite']) ;
        $isMemoCouleur = isset($POST['memoCouleur']) ;
        $dateDebut=$POST['dateDebut'];
        $dateFin=$POST['dateFin'];
        if ($dateDebut > $dateFin)return $_SESSION["notification"]["error"] = Notification::DateDebutSupDatefin($langue);
        if (!($isFreqCardiaque || $isTemp || $isRecoTonalite || $isReflexeVisuel || $isMemoCouleur)) return "error rien de fait";
        $results = $this->userDatabase->rechercheMultiple($isMemoCouleur, $isReflexeVisuel, $isTemp, $isFreqCardiaque,$isRecoTonalite, $dateDebut, $dateFin,$id);
        return $this->formatTestResult($results);
    }

    private function formatTestResult($resultsNonFormat)
    {
        $resultsFormat["freqCardiaque"] ="";
        $resultsFormat["tempPeau"]="";
        $resultsFormat["reflexeVisuel"]="";
        $resultsFormat["recoTonalite"]="";
        $resultsFormat["memoCouleur"]="";
        $resultsFormat["dateExamen"]="";
        foreach ($resultsNonFormat as $test)
        {
            if (isset($test->freqCardiaque))$resultsFormat["freqCardiaque"] .='"'.$test->freqCardiaque.'",';
            if (isset($test->temperature))$resultsFormat["tempPeau"].='"'.$test->temperature.'",';
            if (isset($test->reflexe))$resultsFormat["reflexeVisuel"].='"'.$test->reflexe.'",';
            if (isset($test->tonalite))$resultsFormat["recoTonalite"].='"'.$test->tonalite.'",';
            if (isset($test->memorisation))$resultsFormat["memoCouleur"].='"'.$test->memorisation.'",';
            $resultsFormat["dateExamen"].='"'.$test->dateExamen.'",';
        }
        $resultsFormat["freqCardiaque"] = trim($resultsFormat["freqCardiaque"],",");
        $resultsFormat["tempPeau"] = trim($resultsFormat["tempPeau"],",");
        $resultsFormat["reflexeVisuel"] = trim($resultsFormat["reflexeVisuel"],",");
        $resultsFormat["recoTonalite"] = trim($resultsFormat["recoTonalite"],",");
        $resultsFormat["memoCouleur"] = trim($resultsFormat["memoCouleur"],",");
        $resultsFormat["dateExamen"] = trim($resultsFormat["dateExamen"],",");
        return $resultsFormat;
    }

    public function rechercheUser(array $POST, string $langue, $userId)
    {
        $dateDebut=$POST['dateDebut'];
        $dateFin=$POST['dateFin'];
        if ($dateDebut > $dateFin) return $_SESSION["notification"]["error"] = Notification::DateDebutSupDatefin($langue);
        $result = $this->userDatabase->rechecheSimple($dateDebut,$dateFin,$userId);
        return $this->formatTestResult($result);
    }

    private function changeRang($rang, $userId, $Langue)
    {
        $this->userDatabase->changeRang($rang,$userId);
        return Notification::sucessChangement($Langue);
    }

    public function getAllAdmin()
    {
        $result = $this->userDatabase->getAllAdmin();
        $adminArray = array();
        foreach ($result as $admin)
        {
            $adminArray[$admin->id] = $admin->email;
        }
        return $adminArray;
    }

    private function changeEcoleId($ecoleId, $userId, $Langue)
    {
        $this->userDatabase->changeEcole($ecoleId,$userId);
        return Notification::sucessChangement($Langue);
    }
}