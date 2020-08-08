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
$ecoleId = $params["id"];
$ecolesSystem = new \Psiko\EcolesSystemes();
if (!empty($_POST))
{
    $_SESSION["notification"] = $ecolesSystem->modifierEcole($_POST, $this->getLangue(), $ecoleId);
}
$ecoleType = $ecolesSystem->getEcoleById($ecoleId)->getTypeEcole()
?>
<div class="center">
    <form method="post" action="">
        <div class="form-group">
            <label for="nom" class="form-control-label">Nazwa szkoły:</label> <br>
            <input id="nom" class="form-control" name="nom" value="" placeholder="" type="text">
        </div>        <?= $form->inputSelect("adminId","E-mail administratora",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType"," Wybierz kategorię szkoły : ",
            array("AUTOECOLES" => "Szkoły jazdy", "AVIATION" => "Szkoła lotnicza"),$ecoleType )?>
        <input type="submit" class="btn btn-neutral" value="Dodaj szkołę">
    </form>
</div>
