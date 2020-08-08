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
$ticketId = $params["ticketId"];
$ticketSystem = new \Psiko\TicketSystem();
$ticketSystem->rourvrirTicket($ticketId,$_SESSION["auth"]->getId(),$this->getLangue());
header("Location: /pl/admin/tickets/");
exit();
