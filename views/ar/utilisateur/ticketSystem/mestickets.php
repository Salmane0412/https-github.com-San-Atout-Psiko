<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
$ticket = new \Psiko\database\TicketsTable();
$mesTickets = $ticket->selectAllMyTickets($_SESSION["auth"]->getId());
$aleatoire = \Psiko\helper\Helper::chaineAleatoire(20);
$_SESSION["delete"]["slug"] = $aleatoire;
$_SESSION["delete"]["time"] = date("Y-m-d H:i:s");
?>
<div class="center">
<table class="mes-tickets">
    <thead>
        <th>تاريخ الإرسال</th>
        <th>آخر تعديل<br> تاريخ </th>
        <th>مستوى المعضلة</th>
        <th>حالة الطلب</th>
        <th>العنوان</th>
        <th>أتريدالإحالة للأرشيف؟</th>
        <th>الإجراء</th>
    </thead>
    <tbody>
    <?php
    $i=0;
        foreach ($mesTickets as $t)
        {

            $contenueAAfficher ="";
            $classCSS = ($i % 2 == 0) ? "mes-tickets-td-1" : "mes-tickets-td-2";
            $contenueAAfficher = "<tr class='".$classCSS."'><td>".htmlspecialchars($t->getDateEmission()->format("Y-m-d H:i:s"))."</td>";
            if($t->getDateModification()->format("Y") <= 1999)  {
                $contenueAAfficher .= "<td> ----- </td>";
            }
            else
            {
                $contenueAAfficher .= "<td>".htmlspecialchars($t->getDateModification()->format("Y-m-d H:i:s"))."</td>";
            }
            $contenueAAfficher .= "<td class='tickets-tableau-niveau-problem-".htmlspecialchars($t->getNiveauProblem())."'> </td>
                                   <td>".htmlspecialchars($t->getEtatTicket())."</td>
                                   <td>".htmlspecialchars($t->getTitre())." </td>";
                                   ;
            if($t->isArchive()){
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive checked'>Archivé</td><td>
                                    <input class='btn btn-good' type='button' value='تصفح'></a> </td></tr>";
            }
            else {
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive'>En cours</td><td>
                                    <a href='/fr/tickets/".$t->getIdTicket()."'><input class='btn btn-good' type='button' value='تصفح' ></a>
                                    <a href='/fr/tickets/".$t->getIdTicket()."/fermer/".$aleatoire."'>
                                        <input class='btn btn-negatif' type='button' value='أغلق الطلب' ></a> 
                                    </td></tr>";
            }
            $i++;
            echo $contenueAAfficher;

        }
    ?>
    </tbody>
</table>
</div>
