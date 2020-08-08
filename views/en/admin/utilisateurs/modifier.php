<?php


if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /en/401");
    exit();
}
$userSystem = new \Psiko\UserSystem();
$userId = $params["id"];
if (!empty($_POST))  $userSystem->modificationAdmin($userId,$_POST,$this->getLangue());
$form = new \Psiko\helper\form();
$ecole = new \Psiko\EcolesSystemes();
$arrayEcole = $ecole->getArraysEcole();
?>
<div class="center">
    <h1>Créer une question de FAQ</h1>
    <form class="form-inscription" method="POST" action="">
        <form class="form-inscription" method="POST" action="">

            <div class="form-group">
                <label for="nom" class="form-control-label">Last name :</label> <br>
                <input id="nom" class="form-control" name="nom" value="" placeholder="Last Name" type="text" >
            </div>
            <div class="form-group">
                <label for="prenom" class="form-control-label">First name :</label> <br>
                <input id="prenom" class="form-control" name="prenom" value="" placeholder="First name" type="text">
            </div>
            <div class="form-group">
                <label for="email" class="form-control-label">Email :</label> <br>
                <input id="email" class="form-control" name="email" value="" placeholder="email@isep.fr" type="email" >
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label">Password</label> <br>
                <input id="password" class="form-control" name="password" value="" placeholder="password" type="password" >
            </div>
            <div class="form-group">
                <label for="passwordRpt" class="form-control-label">Repeat password</label> <br>
                <input id="passwordRpt" class="form-control" name="passwordRpt" value="" placeholder="Repeat password" type="password" >
            </div>
            <div class="form-group">
                <label for="adresse" class="form-control-label">Your adress</label> <br>
                <input id="adresse" class="form-control" name="adresse" value="" placeholder="Adress" type="text">
            </div>
            <div class="form-group">
                <label for="codePostal" class="form-control-label">Postal Code</label> <br>
                <input id="codePostal" class="form-control" name="codePostal" value="" placeholder="postal Code" type="text">
            </div>

            <div class="form-group">
                <label for="numeroTelephone" class="form-control-label">Type your phone number</label> <br>
                <input id="numeroTelephone" class="form-control" name="numeroTelephone" value="" placeholder="0601020304" type="text" >
            </div>
            <div class="form-group">
                <label for="birthday" class="form-control-label">Birth date</label> <br>
                <input id="birthday" class="form-control" name="birthday" value="2020-04-30" min="1900-1-1" max="2100-1-1" type="date">
            </div>
            <?= $form->inputSelect("rang","Le rang de l'utilisateur",
                array("administrateur" => "Administrateur", "gestionnaire" => "Gestionnaire", "utilisateur" => "Utilisateur"),
                $userSystem->getUserById($userId)->getRang())?>
            <?= $form->inputSelect("ecoleId","School :", $arrayEcole ,$userSystem->getUserById($userId)->getEcoleId())?>

            <input type="submit" class="btn-neutral btn" value="Modify">
    </form>
</div>