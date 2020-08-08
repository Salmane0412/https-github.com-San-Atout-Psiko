<?php

if (!isset($_SESSION["auth"])) {
    header("Location: /en/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur") {
    header("Location: /en/401");
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
        <?= $form->input("adminEmail","Admin's email","email",true)?>
        <input class="btn btn-neutral" value="Search by admin" type="submit">
    </form>

    <table class="mes-tickets">
        <thead>
            <th>#</th>
            <th>School name</th>
            <th>School type</th>
            <th>Admin's email</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($allEcoles as $ecole)
        {
            $contenueAAfficher ="";
            $typeEcole = ($ecole->getTypeEcole() == "AUTOECOLES") ? "Auto école" : "Ecoles d'aviassion" ;
            $classCSS = ($i % 2 == 0) ? "mes-tickets-td-1" : "mes-tickets-td-2";
            $adminEmail = $userSystem->getUserById($ecole->getAdminId())->getEmail();
            $contenueAAfficher = "<tr class='".$classCSS."'>
                    <td>".htmlspecialchars($ecole->getEcoleId())."</td>
                    <td>".htmlspecialchars($ecole->getNom())."</td>
                    <td>$typeEcole</td>
                    <td><a href='mailto:".htmlspecialchars($adminEmail)."'>".htmlspecialchars($adminEmail)."</a></td>
                    <td>
                        <a href='/en/admin/ecoles/".$ecole->getEcoleId()."/modifier/'><input class='btn btn-good' type='button' value='Modify' ></a>
                        <a href='/en/admin/ecoles/".$ecole->getEcoleId()."/supprimer/".$aleatoire."'>
                        <input class='btn btn-negatif' type='button' value='Delete' ></a> 
                    </td>
                    </tr>";

            $i++;
            echo $contenueAAfficher;

        }
        ?>
        </tbody>
    </table>
    <a href="/en/admin/ecoles/ajouter/"><input type="button" class="btn btn-good" value="Add School"></a>
</div>
