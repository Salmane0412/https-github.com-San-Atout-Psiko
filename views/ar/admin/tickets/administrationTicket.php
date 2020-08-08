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
$ticket = new \Psiko\TicketSystem();
$ticketsAdmin = $ticket->getAllTicketsByRank($_SESSION["auth"]->getRang());
$_SESSION["delete"]["slug"] = $aleatoire;
$_SESSION["delete"]["time"] = date("Y-m-d H:i:s");
?>
<div class="center">
    <table class="mes-tickets">
        <thead>
        <th>تاريخ الإرسال</th>
        <th>تعــديل<br> تاريخ آخـــر </th>
        <th>مستوى المعضلة</th>
        <th>حالة الطلب</th>
        <th>العنوان /th>
        <th>تريد أن تضيف للأرشيف؟</th>
        <th>الإجراء</th>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($ticketsAdmin as $t)
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
                                    <a href='/ar/modir/talabat/".$t->getIdTicket()."'> <input class='btn btn-good' type='button' value='تصفح'></a> 
                                    <a href='/ar/modir/talabat/".$t->getIdTicket()."/iadatfath/'><input class='btn btn-neutral' type='button' value='أعد الفتح'></a></td></tr>";
            }
            else {
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive'>En cours</td><td>
                                    <a href='/ar/modir/talabat/".$t->getIdTicket()."'><input class='btn btn-good' type='button' value='تصفح' ></a>
                                    <a href='/ar/modir/talabat/".$t->getIdTicket()."/aghliq/".$aleatoire."'>
                                        <input class='btn btn-negatif' type='button' value='أضف للأرشيف' ></a> 
                                    </td></tr>";
            }
            $i++;
            echo $contenueAAfficher;

        }
        ?>
        </tbody>
    </table>
</div>
