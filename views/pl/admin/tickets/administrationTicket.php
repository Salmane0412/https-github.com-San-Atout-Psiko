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
$ticket = new \Psiko\TicketSystem();
$ticketsAdmin = $ticket->getAllTicketsByRank($_SESSION["auth"]->getRang());
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
                                    <a href='/pl/admin/tickets/".$t->getIdTicket()."'> <input class='btn btn-good' type='button' value='Konsultować'></a> 
                                    <a href='/pl/admin/tickets/".$t->getIdTicket()."/rouvrir/'><input class='btn btn-neutral' type='button' value='ponownie otwierać'></a></td></tr>";
            }
            else {
                $contenueAAfficher .= "<td class='ticket-tableau-isArchive'>W toku</td><td>
                                    <a href='/pl/admin/tickets/".$t->getIdTicket()."'><input class='btn btn-good' type='button' value='Konsultować' ></a>
                                    <a href='/pl/admin/tickets/".$t->getIdTicket()."/fermer/".$aleatoire."'>
                                        <input class='btn btn-negatif' type='button' value='Archiwum' ></a> 
                                    </td></tr>";
            }
            $i++;
            echo $contenueAAfficher;

        }
        ?>
        </tbody>
    </table>
</div>
