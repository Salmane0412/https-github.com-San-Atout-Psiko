<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /fr/401");
    exit();
}

$aleatoire = \Psiko\helper\Helper::chaineAleatoire(20);
$_SESSION["validate"]["slug"] = $aleatoire;
$_SESSION["validate"]["time"] = date("Y-m-d H:i:s");
$user = new \Psiko\UserSystem();
$userAdmin = $user->getAllUser();
?>

    <table class="mes-tickets center">
        <thead>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Numéro</th>
        <th>Statuts </th>
        <th>Action</th>
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
                $contenueAAfficher .= " <td class='user is checked'>Validé</td>
                                    <td>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Consulter le profil'>
                                        </a>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."/bannir/".$aleatoire."'> 
                                            <input class='btn btn-negatif' type='button' value='Bannir'>
                                        </a> 
                                    </td> ";

            }
            elseif ($u->isValider() === 0) {
                $contenueAAfficher .= "
                                    <td class='user is checked'>Inscrit</td>
                                    <td>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Consulter le profil'>
                                        </a>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='Valider' >
                                        </a> 
                                    </td>  ";
            }else
            {
                $contenueAAfficher .= "
                                    <td class='user is checked'>Bannis</td>
                                    <td>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Consulter le profil'>
                                        </a>
                                        <a href='/fr/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='Debannir' >
                                        </a> 
                                    </td>  ";
            }




        }

        $i++;
        echo $contenueAAfficher.'</tr>';

        ?>
        </tbody>
    </table>
