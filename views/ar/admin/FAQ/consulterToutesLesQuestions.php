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
$faqSystem = new \Psiko\FaqSystem();
$questions = $faqSystem->getAllQuestionByLangue($this->getLangue());
$US = new \Psiko\UserSystem();
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(30);
$_SESSION["delete-FAQ"]["slug"] = $aleatoire;
$_SESSION["delete-FAQ"]["time"] = date("Y-m-d H:i:s");
if (!empty($questions)):
?>
<div class="center">
    <table class="mes-tickets">
        <thead>
        <th>سؤال</th>
        <th>جواب</th>
        <th>اللغة</th>
        <th>تم الإجابة من طرف :</th>
        <th>الإجراء</th>
        </thead>
        <tbody>
            <?php
            foreach ($questions as $q)
            {
                $question = (strlen($q->getQuestion()) < 50)  ? $q->getQuestion() : substr($q->getQuestion(),0,50)."...";
                $reponse = (strlen($q->getReponse()) < 50)  ? $q->getReponse() : substr($q->getReponse(),0,50)."...";
                $contenueLigne = "<td>".htmlspecialchars($question)."</td>
                                  <td class='tableau-FAQ'>".htmlspecialchars($reponse)."</td>";
                switch ($q->getLangue())
                {
                    case "fr":
                        $contenueLigne .= "<td><img src='/Images/logo france.png'></td>";
                        break;
                    case "pl" :
                        $contenueLigne .=  "<td><img src='/Images/logo pologne.png'></td>";
                        break;
                    case "ar" :
                        $contenueLigne .=  "<td><img src='/Images/logo arabe.png'></td>";
                        break;
                    default:
                        $contenueLigne .=  "<td><img src='/Images/logo angleterre.png'></td>";
                        break;
                }//<!--  je dois traduire ici oi pas -->
                $username = ($q->getIdReponder() < 0) ? "anonyme" : $US->getUserById($q->getIdReponder())->getPrenom()." ".$US->getUserById($q->getIdReponder())->getNom();
                $contenueLigne .= "<td>".htmlspecialchars($username)."</td>
                                   <td><a href='/ar/admin/faq/".$q->getId()."'><input class='btn btn-neutral' type='button' value='إظهار' ></a> 
                                   <a href='/ar/admin/faq/".$q->getId()."/modifier/'><input class='btn btn-good' type='button' value='تعديل' ></a>
                                    <a href='/ar/admin/faq/".$q->getId()."/supprimer/".$aleatoire."'>  
                                        <input class='btn btn-negatif' type='button' value='حذف' ></a> </td>
                ";
                echo  "<tr>".$contenueLigne."</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    endif;
    ?>
    <a href="/ar/modir/faq/adif/"><input class='btn btn-good' type='button' value='إضافة سؤال' ></a>
</div>
