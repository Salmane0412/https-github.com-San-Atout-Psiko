<?php


if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /fr/401");
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
                <label for="nom" class="form-control-label">Nom de Famille :</label> <br>
                <input id="nom" class="form-control" name="nom" value="" placeholder="DOE" type="text" >
            </div>
            <div class="form-group">
                <label for="prenom" class="form-control-label">Prénom :</label> <br>
                <input id="prenom" class="form-control" name="prenom" value="" placeholder="John" type="text">
            </div>
            <div class="form-group">
                <label for="email" class="form-control-label">Email :</label> <br>
                <input id="email" class="form-control" name="email" value="" placeholder="John.Doe@isep.fr" type="email" >
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label">Mot de Passe :</label> <br>
                <input id="password" class="form-control" name="password" value="" placeholder="JaimeLesMangarine" type="password" >
            </div>
            <div class="form-group">
                <label for="passwordRpt" class="form-control-label">Répetez le mot de passe :</label> <br>
                <input id="passwordRpt" class="form-control" name="passwordRpt" value="" placeholder="JaimeLesMangarine" type="password" >
            </div>
            <div class="form-group">
                <label for="adresse" class="form-control-label">Votre adresse</label> <br>
                <input id="adresse" class="form-control" name="adresse" value="" placeholder="JaimeLesMangarine" type="text">
            </div>
            <div class="form-group">
                <label for="codePostal" class="form-control-label">code Postal</label> <br>
                <input id="codePostal" class="form-control" name="codePostal" value="" placeholder="exemple : 75015" type="text">
            </div>

            <div class="form-group">
                <label for="numeroTelephone" class="form-control-label">Votre Numero de téléphone</label> <br>
                <input id="numeroTelephone" class="form-control" name="numeroTelephone" value="" placeholder="0601020304" type="text" >
            </div>
            <div class="form-group">
                <label for="birthday" class="form-control-label">Date de naissance</label> <br>
                <input id="birthday" class="form-control" name="birthday" value="2020-04-30" min="1900-1-1" max="2100-1-1" type="date">
            </div>
            <?= $form->inputSelect("rang","Le rang de l'utilisateur",
                                    array("administrateur" => "Administrateur", "gestionnaire" => "Gestionnaire", "utilisateur" => "Utilisateur"),
                                    $userSystem->getUserById($userId)->getRang())?>
            <?= $form->inputSelect("ecoleId","L'école :", $arrayEcole ,$userSystem->getUserById($userId)->getEcoleId())?>
        <input type="submit" class="btn-neutral btn" value="Modifier">
    </form>
</div>