<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur")
{
    header("Location: /ar/401");
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
            <label for="nom" class="form-control-label">:اسم المدرسة </label> <br>
            <input id="nom" class="form-control" name="nom" value="" placeholder="" type="text">
        </div>        <?= $form->inputSelect("adminId",":البريد الإلكتروني للمدير ",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType","بريد المدير الإلكتروني ",
            array("AUTOECOLES" => "تعليم السياقة", "AVIATION" => "مدرسة الطياران"),$ecoleType )?>
        <input type="submit" class="btn btn-neutral" value="أضف مدرسة">
    </form>
</div>
