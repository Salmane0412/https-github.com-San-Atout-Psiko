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
        <?= $form->inputSelect("levelProblem", "Nowy poziom problemu", array("Inconnu" => "inconnu", "Bas" => "bas", "Moyen" => "moyen", "Haut" => "haut", "Critique" => "Critique"), $ticket->getNiveauProblem(), true)?>
        <?= $form->textarea("contenue", "Przyczyna zmiany problemu: ");?>
        <button type="submit" class="btn-submit center btn-good">Wyślij</button>
    </form>
</div>
