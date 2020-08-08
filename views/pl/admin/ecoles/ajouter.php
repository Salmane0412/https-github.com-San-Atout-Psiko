<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /pl/401");
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
        <?= $form->input("nom","Nazwa szkoły : ","text")?>
        <?= $form->inputSelect("adminId","E-mail administratora ",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","Wybierz kategorię szkoły : ",
            array("AUTOECOLES" => "Szkoły jazdy", "AVIATION" => "Szkoła lotnicza"), "AUTOECOLES")?>
        <input type="submit" class="btn btn-neutral" value="Dodaj szkoły">
    </form>
</div>
