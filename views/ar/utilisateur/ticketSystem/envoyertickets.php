<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if (!empty($_POST))
{
    $ticket = new \Psiko\TicketSystem();
    $ticket->createATicket($_POST,$_FILES,"ar");
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Envoyer un tickets</h1>
    <form method="POST" action="" enctype="multipart/form-data" class="form-group ticket-formulaire">
        <?= $form->inputSelect("destinataire", "Choisez le destinataire de votre tickets", array("admin" => "Administrateur", "gestionnaire" => "Gestionnaire"),"admin", true)?>
        <?= $form->input("titre", "Le titre du tickets","text",true,"Titre du tickets")?>
        <?= $form->textarea("contenue", "Explication de votre problème");?>
        <h2>"pdf"و"PNG / JPG" يمكنك إرفاق ثلاثة ملفات "25 ميجا بايت" بحد أقصى  لمساعدتنا في حل مشكلتك والاشكال المسوعة هي  </h2>
        <?= $form->inputFile("fileOne","Le premier fichier")?>
        <?= $form->inputFile("fileTwo","Le premier fichier")?>
        <?= $form->inputFile("fileThree","Le premier fichier")?>
        <button type="submit" class="btn-submit">أرسل الطلب</button>
    </form>
</div>