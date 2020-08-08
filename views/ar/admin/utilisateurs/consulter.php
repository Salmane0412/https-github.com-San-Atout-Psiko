<?php
//Modifié par Come
$userId = $params["id"];

if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if (($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" ) || ($_SESSION["auth"]->getId() != $userId))
{
    header("Location: /ar/401");
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
    <h1><?= htmlspecialchars($user->getNom())?> الإسم العائلي:</h1>
    <br>
    <h1><?= htmlspecialchars($user->getPrenom())?> الإسم الشخصي:</h1>
    <br>
    <h1><?= htmlspecialchars($user->getAdresse())?> العنوان:</h1>
    <br>
     <h1> <?= htmlspecialchars($user->getEmail())?>البريد الالكتروني :</h1>
    <br>
    <h1><?= htmlspecialchars($user->getTelephone())?> الهاتف :</h1>
    <br>
     <h1><?= htmlspecialchars($user->getSexe())?>الجنس:</h1>
    <br>
    <h1><?= htmlspecialchars($user->getRang())?>الرتبة :</h1>
    <br>
    <h1><?= htmlspecialchars($ecoleSystem->getEcoleById($user->getEcoleId())->getNom())?>  مدرسة :</h1>
    <br>
    <?php
    if ($_SESSION["auth"]->getRang() === "administrateur")
        echo "<a href='/ar/admin/utilisateur/".$userId."/modifier/'>
        <input type=\"button\" class=\"btn btn-neutral\" value=\"تعديل\">
    </a>";
    ?>



   
    
</div>
