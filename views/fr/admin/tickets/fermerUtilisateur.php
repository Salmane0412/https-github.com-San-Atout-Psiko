<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "utilisateur")
{
    header("Location: /fr/401");
    exit();
}
if (strtolower($_SESSION["delete"]["slug"]) === $params["idDelete"])
{

    $db = new \Psiko\TicketSystem();
    $db->closeTicketUser($params["idTickets"],$_SESSION["auth"]->getId(),$this->getLangue());
    unset($_SESSION["delete"]["slug"]);
    header("Location: /fr/mes-tickets");
    exit();
}
else
{
    header("Location: /erreur/401");
}

