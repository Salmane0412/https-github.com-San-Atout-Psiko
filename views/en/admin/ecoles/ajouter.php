<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /en/401");
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
        <?= $form->input("nom","Driving school's name :","text")?>
        <?= $form->inputSelect("adminId","Admin's email adress",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","Choose your school type : ",
            array("AUTOECOLES" => "Driving School", "AVIATION" => "Aviation School"), "AUTOECOLES")?>
        <input type="submit" class="btn btn-neutral" value="Add School">
    </form>
</div>
