<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /fr/401");
    exit();
}
$faqSystem = new \Psiko\FaqSystem();
$questions = $faqSystem->getAllQuestionByLangue($this->getLangue());
$US = new \Psiko\UserSystem();
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(30);
$_SESSION["delete-FAQ"]["slug"] = $aleatoire;
$_SESSION["delete-FAQ"]["time"] = date("Y-m-d H:i:s");
if (!empty($questions)):
?>
<div class="center">
    <table class="mes-tickets">
        <thead>
        <th>Question</th>
        <th>Réponse</th>
        <th>Langue</th>
        <th>Répondu par</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            foreach ($questions as $q)
            {
                $question = (strlen($q->getQuestion()) < 50)  ? $q->getQuestion() : substr($q->getQuestion(),0,50)."...";
                $reponse = (strlen($q->getReponse()) < 50)  ? $q->getReponse() : substr($q->getReponse(),0,50)."...";
                $contenueLigne = "<td>".htmlspecialchars($question)."</td>
                                  <td class='tableau-FAQ'>".htmlspecialchars($reponse)."</td>";
                switch ($q->getLangue())
                {
                    case "fr":
                        $contenueLigne .= "<td><img src='/Images/logo france.png'></td>";
                        break;
                    case "pl" :
                        $contenueLigne .=  "<td><img src='/Images/logo pologne.png'></td>";
                        break;
                    case "ar" :
                        $contenueLigne .=  "<td><img src='/Images/logo arabe.png'></td>";
                        break;
                    default:
                        $contenueLigne .=  "<td><img src='/Images/logo angleterre.png'></td>";
                        break;
                }
                $username = ($q->getIdReponder() < 0) ? "anonyme" : $US->getUserById($q->getIdReponder())->getPrenom()." ".$US->getUserById($q->getIdReponder())->getNom();
                $contenueLigne .= "<td>".htmlspecialchars($username)."</td>
                                   <td><a href='/fr/admin/faq/".$q->getId()."'><input class='btn btn-neutral' type='button' value='Afficher' ></a> 
                                   <a href='/fr/admin/faq/".$q->getId()."/modifier/'><input class='btn btn-good' type='button' value='Modifier' ></a>
                                    <a href='/fr/admin/faq/".$q->getId()."/supprimer/".$aleatoire."'>
                                        <input class='btn btn-negatif' type='button' value='Supprimer' ></a> </td>
                ";
                echo  "<tr>".$contenueLigne."</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    endif;
    ?>
    <a href="/fr/admin/faq/ajouter"><input class='btn btn-good' type='button' value='Ajouter une question' ></a>
</div>
