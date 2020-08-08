<?php


namespace Psiko;


use Psiko\database\testTable;
use Psiko\helper\Helper;
use Psiko\helper\Notification;

class TestSystem
{
    /**
     * @var testTable
     */
    private testTable $db;

    /**
     * TestSystem constructor.
     */
    public function __construct()
    {
        $this->db = new testTable();
    }

    public function getMoyenResult()
    {
        $allTest = $this->db->getAllResult();
        $moyenne = array("freqCardiaque" => 0, "temperature" => 0, "memorisation" => 0, "reflexe" => 0, "tonalite" => 0,"total" =>0);
        if (sizeof($allTest) == 0) return $moyenne;
        foreach ($allTest as $test)
        {
            $moyenne["freqCardiaque"]   += $test->getFreqCardiaque();
            $moyenne["temperature"]     += $test->getTemperature();
            $moyenne["memorisation"]    += $test->getMemorisation();
            $moyenne["reflexe"]         += $test->getReflexe();
            $moyenne["tonalite"]        += $test->getTonalite();
        }
        $moyenne["total"] = ($moyenne["freqCardiaque"] + $moyenne["temperature"] + $moyenne["memorisation"] +
                            $moyenne["reflexe"] +$moyenne["tonalite"]) / (5*sizeof($allTest));

        $moyenne["freqCardiaque"]   /=  sizeof($allTest);
        $moyenne["temperature"]     /=  sizeof($allTest);
        $moyenne["memorisation"]    /=  sizeof($allTest);
        $moyenne["reflexe"]         /=  sizeof($allTest);
        $moyenne["tonalite"]        /=  sizeof($allTest);
        return $moyenne;
    }

    public function tableauRecap($langue)
    {
        $infoByUserId = $this->db->getNbOfTestByUserId();
        $tableRecap ="";
        //TODO faire les trads de la valeur du boutton et linkbase polonais / arabes / anglais

        if ($langue === "fr")
        {
            $linkbase = "/fr/resultats/utilisateur/";
            $valueInput =  "Voir plus en détail";
        }
        else if ($langue === "ar")
        {
            $linkbase = "/ar/nataij/mostakhdim";
            $valueInput =  "معرفة المزيد";
        }
        else if ($langue === "pl")
        {
            $linkbase = "/fr/resultats/utilisateur/";
            $valueInput =  "Zobacz więcej szczegółów";
        }
        else
        {
            $linkbase = "/en/resultats/utilisateur/";
            $valueInput =  "See more details";
        }

        for ($i =0; $i < sizeof($infoByUserId); $i++)
        {
            $tableRecap .= "<tr>
                                <td>".htmlspecialchars($infoByUserId[$i]->userId)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->freqCardiaque)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->temperature)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->memorisation)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->reflexe)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->tonalite)."</td>
                                <td>".htmlspecialchars($infoByUserId[$i]->nbTest)."</td>
                                <td>
                                    <a href='".$linkbase.$infoByUserId[$i]->userId."'>
                                        <input type='button' class='btn btn-neutral' value='$valueInput'>
                                    </a>
                                </td>
                             </tr>";
        }
        return $tableRecap;
    }

    public function lancerTest($email,$adminId)
    {
        $userSystem = new UserSystem();
        $user = $userSystem->getUserByEmail($email);
        if (!is_null($user)) $this->db->setNewTest($user[0]->id,$adminId,date("Y-m-d H:i:s"),rand(0,100),
            rand(0,100),rand(0,100),rand(0,100),rand(0,100),Helper::chaineAleatoire(2)."-".Helper::chaineAleatoire(2));

    }
}