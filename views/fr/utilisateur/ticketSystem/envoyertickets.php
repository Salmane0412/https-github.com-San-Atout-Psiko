<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if (!empty($_POST))
{
    $ticket = new \Psiko\TicketSystem();
    $ticket->createATicket($_POST,$_FILES,"fr");
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Envoyer un tickets</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->inputSelect("destinataire", "Choisez le destinataire de votre tickets", array("admin" => "Administrateur", "gestionnaire" => "Gestionnaire"),"admin", true)?>
        <?= $form->input("titre", "Le titre du tickets","text",true,"Titre du tickets")?>
        <?= $form->textarea("contenue", "Explication de votre problème");?>
        <h2> Vous pouvez joindre trois fichier de maximum 25Mo au format PDF ou PNG/JPG pour aider a mieux comprendre votre problème</h2>
        <?= $form->inputFile("fileOne","Le premier fichier")?>
        <?= $form->inputFile("fileTwo","Le premier fichier")?>
        <?= $form->inputFile("fileThree","Le premier fichier")?>
        <button type="submit" class="btn-submit">Soumettre le tickets</button>
    </form>
</div>