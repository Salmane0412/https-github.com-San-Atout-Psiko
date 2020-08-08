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

$idFAQ = $params["questionId"];
$date = new DateTime();
$difference = $date->diff(new \DateTime($_SESSION["delete-FAQ"]["time"]));
$isUnderTwentyMinutes = ($difference->y === 0) && ($difference->m === 0) && ($difference->d === 0) && ($difference->h === 0) && ($difference->i <= 20) ;
if ($_SESSION["delete-FAQ"]["slug"] === $params["idDelete"] && $isUnderTwentyMinutes)
{

    $faqSystem = new \Psiko\FaqSystem();
    $faqSystem->supprimerQuestion($idFAQ);
    unset($_SESSION["delete-FAQ"]["time"]);
    unset($_SESSION["delete-FAQ"]["slug"] );
    header("Location: /fr/admin/faq");
    exit();
}