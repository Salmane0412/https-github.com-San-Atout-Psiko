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
$ticketId = $params["ticketId"];
$db = new \Psiko\database\TicketsTable();
$ticket =  $db->selectTicketByID($ticketId);
$form = new \Psiko\helper\form();
if (!empty($_POST))
{
    $ticketSystem = new \Psiko\TicketSystem();
    $ticketSystem->changerLevelProblem($_POST,$ticketId,$this->getLangue(),$_SESSION["auth"]->getId());
}
?>

<div class="center">
    <h1><?=$ticket->getTitre()?></h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->inputSelect("levelProblem", "New Problem's level", array("Inconnu" => "Unknown", "Bas" => "Low", "Moyen" => "Middle", "Haut" => "high", "Critique" => "Critical"), $ticket->getNiveauProblem(), true)?>
        <?= $form->textarea("Content", "Why did you change the problem's level: ");?>
        <button type="submit" class="btn-submit center btn-good">Send</button>
    </form>
</div>
