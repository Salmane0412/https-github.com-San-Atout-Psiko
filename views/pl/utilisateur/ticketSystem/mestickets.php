<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
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
        <th>Data wysyłki</th>
        <th>Data ostatniej <br> modyfikacji</th>
        <th>Poziom problemu</th>
        <th>Status biletu</th>
        <th>tytuł</th>
        <th>Archiwum?</th>
        <th>Akcja</th>
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
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive checked'>Zarchiwizowane</td><td>
                                    <input class='btn btn-good' type='button' value='Konsultować'></a> </td></tr>";
            }
            else {
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive'>W toku</td><td>
                                    <a href='/pl/tickets/".$t->getIdTicket()."'><input class='btn btn-good' type='button' value='Konsultować' ></a>
                                    <a href='/pl/tickets/".$t->getIdTicket()."/fermer/".$aleatoire."'>
                                        <input class='btn btn-negatif' type='button' value='Zamknij bilety' ></a> 
                                    </td></tr>";
            }
            $i++;
            echo $contenueAAfficher;

        }
    ?>
    </tbody>
</table>
</div>
