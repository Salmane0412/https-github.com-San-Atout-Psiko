<?php
//Modifié par Come
$userId = $params["id"];

if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if (!($_SESSION["auth"]->getRang() == "administrateur" || ($_SESSION["auth"]->getId() != $userId)  ||$_SESSION["auth"]->getRang() != "gestionnaire" ))
{
    header("Location: /fr/401");
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
    <h1>Nom de famille: <?= htmlspecialchars($user->getNom())?></h1>
    <br>
    <h1>Prénom : <?= htmlspecialchars($user->getPrenom())?></h1>
    <br>
    <h1>Adresse : <?= htmlspecialchars($user->getAdresse())?></h1>
    <br>
     <h1>Email : <?= htmlspecialchars($user->getEmail())?></h1>
    <br>
    <h1>Telephone : <?= htmlspecialchars($user->getTelephone())?></h1>
    <br>
     <h1>Sexe : <?= htmlspecialchars($user->getSexe())?></h1>
    <br>
    <h1>Rang : <?= htmlspecialchars($user->getRang())?></h1>
    <br>
    <h1>Ecole : <?= htmlspecialchars($ecoleSystem->getEcoleById($user->getEcoleId())->getNom())?></h1>
    <br>
    <?php
    if ($_SESSION["auth"]->getRang() === "administrateur")
        echo "<a href='/fr/admin/utilisateur/".$userId."/modifier/'>
        <input type=\"button\" class=\"btn btn-neutral\" value=\"Modifier\">
    </a>";
    ?>



   
    
</div>
