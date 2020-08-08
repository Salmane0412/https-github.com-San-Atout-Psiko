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
            <label for="nom" class="form-control-label">Le nom de l'école :</label> <br>
            <input id="nom" class="form-control" name="nom" value="" placeholder="" type="text">
        </div>        <?= $form->inputSelect("adminId","Le mail de l'administrateur",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","Choissez votre catégorie d'école : ",
            array("AUTOECOLES" => "Auto ecoles", "AVIATION" => "Ecole d'aviation"),$ecoleType )?>
        <input type="submit" class="btn btn-neutral" value="Ajouter l'écoles">
    </form>
</div>
