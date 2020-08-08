<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if (!empty($_POST))
{
    $ticket = new \Psiko\TicketSystem();
    $ticket->createATicket($_POST,$_FILES,"pl");
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Wyślij bilet</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->inputSelect("destinataire", "Wybierz odbiorcę swoich biletów", array("admin" => "Administrator", "gestionnaire" => "zarządzający"),"admin", true)?>
        <?= $form->input("titre", "Tytuł biletów","text",true,"Tytuł biletu")?>
        <?= $form->textarea("contenue", "Wyjaśnienie twojego problemu");?>
        <h2> ożesz załączyć trzy pliki o maksymalnej wielkości 25 MB w formacie PDF lub PNG / JPG, aby lepiej zrozumieć swój problem</h2>
        <?= $form->inputFile("fileOne","Pierwszy plik")?>
        <?= $form->inputFile("fileTwo","Drugi plik")?>
        <?= $form->inputFile("fileThree","Trzeci plik")?>
        <button type="submit" class="btn-submit">Prześlij bilet</button>
    </form>
</div>