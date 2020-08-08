<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /pl/401");
    exit();
}
$ticketId = $params["idTickets"];
$date = new DateTime();
$difference = $date->diff(new \DateTime($_SESSION["delete"]["time"]));
$isUnderTwentyMinutes = ($difference->y === 0) && ($difference->m === 0) && ($difference->d === 0) && ($difference->h === 0) && ($difference->i <= 20) ;
if (strtolower($_SESSION["delete"]["slug"]) === $params["idDelete"] && $isUnderTwentyMinutes)
{
    $ticketSystem = new \Psiko\TicketSystem();
    $ticketSystem->closeTicketAdmin($ticketId,$_SESSION["auth"]->getId(),$this->getLangue());
    header("Location: /pl/admin/tickets/");
    exit();
}
else
{
    header("Location: /pl/401");
}

