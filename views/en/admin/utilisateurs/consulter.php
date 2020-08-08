<?php
//Modifié par Come
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /en/401");
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
    <h1>Last name: <?= htmlspecialchars($user->getNom())?></h1>
    <br>
    <h1>First Name : <?= htmlspecialchars($user->getPrenom())?></h1>
    <br>
    <h1>Adress : <?= htmlspecialchars($user->getAdresse())?></h1>
    <br>
     <h1>Email : <?= htmlspecialchars($user->getEmail())?></h1>
    <br>
    <h1>Phone number : <?= htmlspecialchars($user->getTelephone())?></h1>
    <br>
     <h1>Sex : <?= htmlspecialchars($user->getSexe())?></h1>
    <br>
    <h1>Rank : <?= htmlspecialchars($user->getRang())?></h1>
    <br>
    <h1>Ecole : <?= htmlspecialchars($ecoleSystem->getEcoleById($user->getEcoleId())->getNom())?></h1>
    <br>
    <?php
    if ($_SESSION["auth"]->getRang() === "administrateur")
        echo "<a href='/fr/admin/utilisateur/".$userId."/modifier/'>
        <input type=\"button\" class=\"btn btn-neutral\" value=\"Modify\">
    </a>";
    ?>



   
    
</div>