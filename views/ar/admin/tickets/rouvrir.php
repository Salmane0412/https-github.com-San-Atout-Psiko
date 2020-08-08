<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");   
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /ar/401");
    exit();
}
$ticketId = $params["ticketId"];
$ticketSystem = new \Psiko\TicketSystem();
$ticketSystem->rourvrirTicket($ticketId,$_SESSION["auth"]->getId(),$this->getLangue());
header("Location: /ar/admin/tickets/");
exit();
