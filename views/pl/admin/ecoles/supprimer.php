<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /pl/401");
    exit();
}
$ecole = $params["id"];
$date = new DateTime();
$difference = $date->diff(new \DateTime($_SESSION["ecole"]["time"]));
$isUnderTwentyMinutes = ($difference->y === 0) && ($difference->m === 0) && ($difference->d === 0) && ($difference->h === 0) && ($difference->i <= 20) ;
if (strtolower($_SESSION["ecole"]["slug"]) === $params["deleteEcole"] && $isUnderTwentyMinutes)
{
    $ecoleSystem = new \Psiko\database\EcoleDatabase();
    $ecoleSystem->deleteEcole($ecole);
    header("Location: /pl/admin/ecoles/");
    exit();
}
else
{
    header("Location: /pl/401");
}