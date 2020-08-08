<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /ar/401");
    exit();
}

$aleatoire = \Psiko\helper\Helper::chaineAleatoire(20);
$_SESSION["validate"]["slug"] = $aleatoire;
$_SESSION["validate"]["time"] = date("Y-m-d H:i:s");
$user = new \Psiko\UserSystem();
$userAdmin = $user->getAllUser();
?>

    <table class="mes-users center">
        <thead>
        <th>الإسم العائلي</th>
        <th>الإسم الشخصي</th>
        <th>البريد الالكتروني</th>
        <th>رقم الهاتف</th>
        <th>الحالات </th>
        <th>الإجراء</th>
        </thead>
        <tbody>
        <?php
        $i=0;
        $contenueAAfficher = "";
        foreach ($userAdmin as $u)
        {
            $contenueAAfficher .="<tr>";
            $classCSS = ($i % 2 == 0) ? "mes-users-td-1" : "mes-users-td-2";
            $contenueAAfficher .= "<td>".htmlspecialchars($u->getNom())." </td>
                                   <td>".htmlspecialchars($u->getPrenom())."</td>
                                   <td>".htmlspecialchars($u->getEmail())."</td>
                                   <td>".htmlspecialchars($u->getTelephone())."</td>";

            if($u->isValider() === 1){
                $contenueAAfficher .= " <td class='user is checked'>تم التحقق</td>
                                    <td>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='تصفح الملف الشخصي'>
                                        </a>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."/bannir/".$aleatoire."'>  // je dois traduire bannir ou pas 
                                            <input class='btn btn-negatif' type='button' value='إزالة'>
                                        </a> 
                                    </td> ";

            }
            elseif ($u->isValider() === 0) {
                $contenueAAfficher .= "
                                    <td class='user is checked'>مسجل</td>
                                    <td>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='تصفح الملف الشخصي'>
                                        </a>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='تحقق' >
                                        </a> 
                                    </td>  ";
            }else
            {
                $contenueAAfficher .= "
                                    <td class='user is checked'>Bannis</td>
                                    <td>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='تصفح الملف الشخصي'>
                                        </a>
                                        <a href='/ar/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='تراجع عن الإزالة' >
                                        </a> 
                                    </td>  ";
            }




        }

        $i++;
        echo $contenueAAfficher.'</tr>';

        ?>
        </tbody>
    </table>
