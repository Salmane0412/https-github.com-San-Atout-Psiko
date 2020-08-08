<?php
//Modifié par Come
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
$userId = $params["id"];
$date = new DateTime();
$difference = $date->diff(new \DateTime($_SESSION["validate"]["time"]));
$isUnderTwentyMinutes = ($difference->y === 0) && ($difference->m === 0) && ($difference->d === 0) && ($difference->h === 0) && ($difference->i <= 20) ;
if (strtolower($_SESSION["validate"]["slug"]) === $params["validerUser"] && $isUnderTwentyMinutes)
{
    $userSystem = new \Psiko\UserSystem();
    $userSystem->validateuser($userId,$this->getLangue());
    header("Location: /fr/admin/utilisateur/");
    exit();
}
else
{
    header("Location: /fr/401");
}