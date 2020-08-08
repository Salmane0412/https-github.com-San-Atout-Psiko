<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "utilisateur")
{
    header("Location: /en/401");
    exit();
}
if ($_SESSION["delete"]["slug"] === $params["idDelete"])
{

    $db = new \Psiko\TicketSystem();
    $db->closeTicketUser($params["idTickets"],$_SESSION["auth"]->getId(),$this->getLangue());
    unset($_SESSION["delete"]["slug"]);
    header("Location: /en/mes-tickets");
    exit();
}
else
{
    header("Location: /erreur/401");
}

