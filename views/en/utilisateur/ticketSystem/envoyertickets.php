<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if (!empty($_POST))
{
    $ticket = new \Psiko\TicketSystem();
    $ticket->createATicket($_POST,$_FILES,"en");
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Envoyer un tickets</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->inputSelect("destinataire", "Select the personn you want to send the ticket to", array("admin" => "Administrator", "gestionnaire" => "Keeper"),"admin", true)?>
        <?= $form->input("titre", "Title","text",true,"Ticket's title")?>
        <?= $form->textarea("content", "Explain your issue here");?>
        <h2> You can join up to 3 files to explain your issue</h2>
        <?= $form->inputFile("fileOne","File 1")?>
        <?= $form->inputFile("fileTwo","File 2")?>
        <?= $form->inputFile("fileThree","File 2")?>
        <button type="submit" class="btn-submit">Submit ticket</button>
    </form>
</div>