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
if (!empty($_POST))
{
    $FAQSystem = new \Psiko\FaqSystem();
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
    $FAQSystem->newQuestion($_POST);
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1> Utwórz pytanie FAQ ( Często zadawane pytanie ) </h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "Język : ", array("fr" => "Français", "ar" => "Arabe", "en" => "Anglais", "pl" => "Polonais"), $this->getLangue(), true)?>
        <?= $form->input("question", "Pytanie","text",true,"pytanie o wszystko i cokolwiek")?>
        <?= $form->textarea("reponse", "Odpowiedź, którą chcesz przynieść");?>
        <?= $form->input("isAnonyme","Odpowiedz anonimowo","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Dodaj</button>

    </form>
</div>