<?php

if (!isset($_SESSION["auth"])) {
    header("Location: /ar/tasjildokhol/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur") {
    header("Location: /ar/401");
    exit();
}
$ecoles = new \Psiko\EcolesSystemes();
$allEcoles = $ecoles->getAllEcoles($this->getLangue());
$userSystem = new \Psiko\UserSystem();
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(30);
$_SESSION["ecole"]["slug"] = $aleatoire;
$_SESSION["ecole"]["time"] = date("Y-m-d H:i:s");
$form = new \Psiko\helper\form();
if (!empty($_POST))
{
    $allEcoles = $ecoles->getByAdminMail($_POST["adminEmail"]);
}
?>
<div class="center">
    <form action="" method="post" style="margin-bottom: 2%">
        <?= $form->input("adminEmail","بريد المدير الإلكتروني","email",true)?>
        <input class="btn btn-neutral" value="بحث بالمدير " type="submit">
    </form>

    <table class="mes-tickets">
        <thead>
            <th>#</th>
            <th>اسم المدرسة </th>
            <th>نوعية المــدرسة</th>
            <th>بريد المدير الإلكتروني</th>
            <th>الاجراء</th>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($allEcoles as $ecole)
        {
            $contenueAAfficher ="";
            $typeEcole = ($ecole->getTypeEcole() == "AUTOECOLES") ? "تعليم السياقة" : "مدرسة الطياران" ;   // ça m'a changé l'ordre en auto ecole et ecole d'avia
            $classCSS = ($i % 2 == 0) ? "mes-tickets-td-1" : "mes-tickets-td-2";
            $adminEmail = $userSystem->getUserById($ecole->getAdminId())->getEmail();
            $contenueAAfficher = "<tr class='".$classCSS."'>
                    <td>".htmlspecialchars($ecole->getEcoleId())."</td>
                    <td>".htmlspecialchars($ecole->getNom())."</td>
                    <td>$typeEcole</td>
                    <td><a href='mailto:".htmlspecialchars($adminEmail)."'>".htmlspecialchars($adminEmail)."</a></td>
                    <td>
                        <a href='/fr/admin/ecoles/".$ecole->getEcoleId()."/tabdil/'><input class='btn btn-good' type='button' value='تعديل ' ></a>
                        <a href='/fr/admin/ecoles/".$ecole->getEcoleId()."/hadf/".$aleatoire."'>
                        <input class='btn btn-negatif' type='button' value='حذف' ></a> 
                    </td>
                    </tr>";

            $i++;
            echo $contenueAAfficher;

        }
        ?>
        </tbody>
    </table>
    <a href="/ar/modir/madaris/adif/"><input type="button" class="btn btn-good" value="أضف مدرسة"></a>
</div>
