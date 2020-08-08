<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /pl/401");
    exit();
}
$idQuestion = $params["questionId"];
$faqSystem = new \Psiko\FaqSystem();
$question = $faqSystem->getQuestionByID($idQuestion);
$username = "un adminnistrateur anonyme";
if ($question->getIdReponder() > 0)
{
    $userSystem = new \Psiko\UserSystem();
    $username = $userSystem->getUserById($question->getIdReponder())->getPrenom() ." " . $userSystem->getUserById($question->getIdReponder())->getNom();
}
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(30);
$_SESSION["delete-FAQ"]["slug"] = $aleatoire;
$_SESSION["delete-FAQ"]["time"] = date("Y-m-d H:i:s");
switch ($question->getLangue())
{
    case "fr":
        $src = "/Images/logo france.png";
        break;
    case "pl" :
        $src =  "/Images/logo pologne.png";
        break;
    case "ar" :
        $src =  "/Images/logo arabe.png";
        break;
    default:
        $src =  "/Images/logo angleterre.png";
        break;
}

?>
<div class="center consulter-faq-admin">
    <h1> <?= htmlspecialchars($question->getQuestion()) ?> </h1>
    <h2> Odpowiedź od <?= htmlspecialchars($username)?> </h2>
    <h2> Język : <img src="<?=$src?>"></h2>
    <p class="center">
        <?= htmlspecialchars($question->getReponse()) ?>
    </p>
    <a class="faq-link-aide" href='/pl/admin/faq/<?= $question->getId()?>/modifier/'>
        <input class='btn btn-good' type='button' value='Edytuj' >
    </a>
    <a class="faq-link-aide" href='/pl/admin/faq/<?= $question->getId()?>/supprimer/<?=$aleatoire?>'>
        <input class='btn btn-negatif' type='button' value='Usunąć' >
    </a>
</div>

