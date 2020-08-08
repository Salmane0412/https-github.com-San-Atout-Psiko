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
$form = new \Psiko\helper\form();
if (!empty($_POST))
{
    $testSystem = new \Psiko\TestSystem();
    $testSystem->lancerTest($_POST["email"], $_SESSION["auth"]->getId());
}
?>
<form method="post" action="">
    <?=$form->input("email", "user Email","email",true,"john.doe@isep.fr")?>
    <input type="submit" class="btn-neutral btn" value="Lancer le test">
</form>