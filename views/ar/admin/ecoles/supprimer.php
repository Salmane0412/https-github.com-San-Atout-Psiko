<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /ar/401");
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
    header("Location: /ar/modir/madaris/");
    exit();
}
else
{
    header("Location: /ar/401");
}