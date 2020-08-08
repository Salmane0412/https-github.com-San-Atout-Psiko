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
if (!empty($_POST))
{
    $ecolesSystem = new \Psiko\EcolesSystemes();
    $_SESSION["notification"] = $ecolesSystem->ajouterEcoles($_POST, $this->getLangue());
}
?>
<div class="center">
    <form method="post" action="">
        <?= $form->input("nom",":اسم المدرسة ","text")?>
        <?= $form->inputSelect("adminId","بريد المدير الإلكتروني",$adminArray, "1")?>
        <?= $form->inputSelect("ecoleType",":قم بإختيار نوعية مدرستك  ",
            array("AUTOECOLES" => "تعليم السياقة", "AVIATION" => "مدرسة الطياران"), "AUTOECOLES")?>
        <input type="submit" class="btn btn-neutral" value="أضف المدرسة">
    </form>
</div>
