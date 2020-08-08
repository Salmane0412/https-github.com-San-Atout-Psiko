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
if (!empty($_POST)) 
{
    $FAQSystem = new \Psiko\FaqSystem();
    $_POST["isAnonyme"] = isset($_POST["isAnonyme"]) ? -1 : $_SESSION["auth"]->getId();
    $FAQSystem->newQuestion($_POST);
}
$form = new \Psiko\helper\form();
?>
<div class="center">
    <h1>Create a new Q/A question</h1>
    <form method="POST" action="" class="form-group ticket-formulaire">
        <?= $form->inputSelect("langue", "Language: ", array("fr" => "French", "ar" => "Arabic", "en" => "English", "pl" => "Polish"), $this->getLangue(), true)?>
        <?= $form->input("question", "La question","text",true,"question about anything")?>
        <?= $form->textarea("reponse", "Write here the reply you want to submit");?>
        <?= $form->input("isAnonyme","Answer anonymously","checkbox",false,null)?>
        <button type="submit" class="btn-submit center btn-good">Ajouter</button>

    </form>
</div>