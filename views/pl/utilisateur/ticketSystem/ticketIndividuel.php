<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
$ticketId = $params["ticketId"];
$db = new \Psiko\database\TicketsTable();
$ticket =  $db->selectTicketByID($ticketId);

if($ticket->getDateModification()->format("Y") <= 1999)  {
    $dateModification = " ---------";
}
else
{
    $dateModification = htmlspecialchars($ticket->getDateModification()->format("Y-m-d H:i:s"));
}

?>
<div class="center ticket-individuel">
    <h1>Bilet <?=$ticket->getIdTicket()?>: <?= htmlspecialchars($ticket->getTitre())?></h1>
    <br>
    <h2>Cel: <?= $ticket->getCible()?></h2>
    <h2>Poziom problemu :  <?=$ticket->getNiveauProblem()?></h2>
    <h2>Status biletu : <?=$ticket->getEtatTicket()?></h2>
    <h2>Data otwarcia : <?=$ticket->getDateEmission()->format("Y-m-d H:i:s")?></h2>
    <h2>Data ostatniej modyfikacji : <?=$dateModification?></h2>
    <h2></h2>
    <h2>Zawartość</h2>
    <p class="center ticket-contenue">
        <?php
        $texte = explode("<br>",$ticket->formatContenue());
        foreach ($texte as $t)
        {
            echo htmlspecialchars($t)."<br>";
        }
        ?>
    </p>
    <h2>Odpowiedź</h2>
    <p class="center ticket-contenue">
        <?php
        $texte = explode("<br>",$ticket->formatResponse());
        foreach ($texte as $t)
        {
            echo htmlspecialchars($t)."<br>";
        }
        ?>
    </p>
    <?php
    $i=1;
    $links = explode(" ",$ticket->getFichierSupllementaireLink()) ;
    foreach ($links as $link)
    {
        if ($link != "") echo '<a href="/'.$link.'"  target="_blank"><button class="btn btn-neutral">Numer pliku '.$i.'</button></a> <br>';
        $i++;
    }
    ?>
    <a class="center" href="/pl/tickets/<?=$ticket->getIdTicket()?>/repondre/">
        <button class="btn-repondre btn-good">Odpowiedz</button>
    </a>
</div>
