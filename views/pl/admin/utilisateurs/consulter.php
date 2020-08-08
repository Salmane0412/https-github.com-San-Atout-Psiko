<?php
//Modifié par Come
$userId = $params["id"];

if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if (($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" ) || ($_SESSION["auth"]->getId() != $userId))
{
    header("Location: /pl/401");
    exit();
}

$userId = $params["id"];
$db = new \Psiko\UserSystem();
$user =  $db->getUserByID($userId);
$ecoleSystem = new \Psiko\EcolesSystemes();
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(20);
$_SESSION["modif"]["slug"] = $aleatoire;
$_SESSION["modif"]["time"] = date("Y-m-d H:i:s");

?>
<div class="center ticket-individuel">
    <h1>Nazwisko: <?= htmlspecialchars($user->getNom())?></h1>
    <br>
    <h1>Imię: <?= htmlspecialchars($user->getPrenom())?></h1>
    <br>
    <h1>Adres: <?= htmlspecialchars($user->getAdresse())?></h1>
    <br>
     <h1>E-mail : <?= htmlspecialchars($user->getEmail())?></h1>
    <br>
    <h1>Telefon : <?= htmlspecialchars($user->getTelephone())?></h1>
    <br>
     <h1>płeć :<?= htmlspecialchars($user->getSexe())?></h1>
    <br>
    <h1>Ranga : <?= htmlspecialchars($user->getRang())?></h1>
    <br>
    <h1>Ecole : <?= htmlspecialchars($ecoleSystem->getEcoleById($user->getEcoleId())->getNom())?></h1>
    <br>

    <?php
    if ($_SESSION["auth"]->getRang() === "administrateur")
        echo "<a href='/pl/admin/utilisateur/".$userId."/modifier/'>
        <input type=\"button\" class=\"btn btn-neutral\" value=\"Edytować\">
    </a>";
    ?>



   
    
</div>
