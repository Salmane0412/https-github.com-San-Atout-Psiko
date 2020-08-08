<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /fr/401");
    exit();
}
$form = new \Psiko\helper\form();
$userSystem = new \Psiko\UserSystem();
$adminArray = $userSystem->getAllAdmin();
if (!empty($_POST))
{
    $ecolesSystem = new \Psiko\EcolesSystemes();
    $_SESSION["notification"] = $ecolesSystem->ajouterEcoles($_POST, $this->getLangue());
}
?>
<div class="center">
    <form method="post" action="">
        <?= $form->input("nom","Le nom de l'école :","text")?>
        <?= $form->inputSelect("adminId","Le mail de l'administrateur",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","Choissez votre catégorie d'école : ",
            array("AUTOECOLES" => "Auto ecoles", "AVIATION" => "Ecole d'aviation"), "AUTOECOLES")?>
        <input type="submit" class="btn btn-neutral" value="Ajouter l'écoles">
    </form>
</div>
