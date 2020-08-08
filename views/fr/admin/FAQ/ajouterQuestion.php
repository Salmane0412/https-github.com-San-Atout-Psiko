<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /fr/401");
    exit();
}
if (!empty($_POST))
{
    $FAQSystem = new \Psiko\FaqSystem();
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
    $FAQSystem->newQuestion($_POST);
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Créer une question de FAQ</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "La langue : ", array("fr" => "Français", "ar" => "Arabe", "en" => "Anglais", "pl" => "Polonais"), $this->getLangue(), true)?>
        <?= $form->input("question", "La question","text",true,"question sur la vie, l'univers et le reste")?>
        <?= $form->textarea("reponse", "La réponse que vous souhaiter apporter");?>
        <?= $form->input("isAnonyme","Répondre anonymement","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Ajouter</button>

    </form>
</div>