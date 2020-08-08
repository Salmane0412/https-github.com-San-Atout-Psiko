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
            <label for="nom" class="form-control-label">School's name :</label> <br>
            <input id="nom" class="form-control" name="nom" value="" placeholder="" type="text">
        </div>        <?= $form->inputSelect("adminId","Admin's email",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","Choose your school type : ",
            array("AUTOECOLES" => "Driving School", "AVIATION" => "Flying School"),$ecoleType )?>
        <input type="submit" class="btn btn-neutral" value="Add school">
    </form>
</div>
