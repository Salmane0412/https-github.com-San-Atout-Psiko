<?php
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
$ticketId = $params["idTickets"];
$date = new DateTime();
$difference = $date->diff(new \DateTime($_SESSION["delete"]["time"]));
$isUnderTwentyMinutes = ($difference->y === 0) && ($difference->m === 0) && ($difference->d === 0) && ($difference->h === 0) && ($difference->i <= 20) ;
if ($_SESSION["delete"]["slug"] === $params["idDelete"] && $isUnderTwentyMinutes)
{
    $ticketSystem = new \Psiko\TicketSystem();
    $ticketSystem->closeTicketAdmin($ticketId,$_SESSION["auth"]->getId(),$this->getLangue());
    header("Location: /en/admin/tickets/");
    exit();
}
else
{
    header("Location: /en/401");
}

