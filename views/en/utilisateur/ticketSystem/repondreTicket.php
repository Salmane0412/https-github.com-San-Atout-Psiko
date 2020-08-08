<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
$ticketsId = $params["ticketId"];
$db = new \Psiko\database\TicketsTable();
$ticket = $db->selectTicketByID($ticketsId);
$form = new \Psiko\helper\form();
if (!empty($_POST))
{
    $ticketSystem = new \Psiko\TicketSystem();
    $ticketSystem->repondreTickets($_POST["reponse"],$ticketsId,$this->getLangue(),$_SESSION["auth"]->getId());
}
?>

<div class="center">
    <h1><?=$ticket->getTitre()?></h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->textarea("reponse", "Answer : ");?>
        <button type="submit" class="btn-submit center btn-good">Send</button>
    </form>
</div>

