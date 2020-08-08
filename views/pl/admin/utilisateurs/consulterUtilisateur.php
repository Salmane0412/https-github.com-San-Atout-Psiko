<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /pl/401");
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
        <th>Nazwisko </th>
        <th>Imię </th>
        <th>E-mail</th>
        <th>Numer </th>
        <th>Status</th>
        <th>akcja</th>
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
                $contenueAAfficher .= " <td class='user is checked'>Zatwierdź</td>
                                    <td>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Zobacz profil'>
                                        </a>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."/bannir/".$aleatoire."'> 
                                            <input class='btn btn-negatif' type='button' value='Wygnać'>
                                        </a> 
                                    </td> ";

            }
            elseif ($u->isValider() === 0) {
                $contenueAAfficher .= "
                                    <td class='user is checked'>Zarejestrowany</td>
                                    <td>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Zobacz profil'>
                                        </a>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='Zatwierdź' >
                                        </a> 
                                    </td>  ";
            }else
            {
                $contenueAAfficher .= "
                                    <td class='user is checked'>Wygnany</td>
                                    <td>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."'> 
                                            <input class='btn btn-neutral' type='button' value='Zobacz profil'>
                                        </a>
                                        <a href='/pl/admin/utilisateur/".$u->getId()."/valider/".$aleatoire." '>
                                            <input class='btn btn-good' type='button' value='odwygnać' >
                                        </a> 
                                    </td>  ";
            }




        }

        $i++;
        echo $contenueAAfficher.'</tr>';

        ?>
        </tbody>
    </table>
