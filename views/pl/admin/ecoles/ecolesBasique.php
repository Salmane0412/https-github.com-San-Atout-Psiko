<?php

if (!isset($_SESSION["auth"])) {
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur") {
    header("Location: /pl/401");
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
        <?= $form->input("adminEmail","Adres e-mail administratora","email",true)?>
        <input class="btn btn-neutral" value="Wyszukaj według administratora" type="submit">
    </form>

    <table class="mes-tickets">
        <thead>
            <th>#</th>
            <th>Nazwa szkoły</th>
            <th>Typ szkoły</th>
            <th>Adres e-mail administratora</th>
            <th>Akcja</th>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($allEcoles as $ecole)
        {
            $contenueAAfficher ="";
            $typeEcole = ($ecole->getTypeEcole() == "AUTOECOLES") ? "Szkoła jazdy" : "Szkoły lotnicze" ;
            $classCSS = ($i % 2 == 0) ? "mes-tickets-td-1" : "mes-tickets-td-2";
            $adminEmail = $userSystem->getUserById($ecole->getAdminId())->getEmail();
            $contenueAAfficher = "<tr class='".$classCSS."'>
                    <td>".htmlspecialchars($ecole->getEcoleId())."</td>
                    <td>".htmlspecialchars($ecole->getNom())."</td>
                    <td>$typeEcole</td>
                    <td><a href='mailto:".htmlspecialchars($adminEmail)."'>".htmlspecialchars($adminEmail)."</a></td>
                    <td>
                        <a href='/pl/admin/ecoles/".$ecole->getEcoleId()."/modifier/'><input class='btn btn-good' type='button' value='Edytować' ></a>
                        <a href='/pl/admin/ecoles/".$ecole->getEcoleId()."/supprimer/".$aleatoire."'>
                        <input class='btn btn-negatif' type='button' value='Usunąć' ></a> 
                    </td>
                    </tr>";

            $i++;
            echo $contenueAAfficher;

        }
        ?>
        </tbody>
    </table>
    <a href="/pl/admin/ecoles/ajouter/"><input type="button" class="btn btn-good" value="Dodaj szkołę"></a>
</div>
