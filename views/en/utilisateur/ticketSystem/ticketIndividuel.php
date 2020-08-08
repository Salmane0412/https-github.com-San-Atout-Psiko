<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
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
    <h1>Ticket <?=$ticket->getIdTicket()?>: <?= htmlspecialchars($ticket->getTitre())?></h1>
    <br>
    <h2>Target :  <?= $ticket->getCible()?></h2>
    <h2>Problem's level : <?=$ticket->getNiveauProblem()?></h2>
    <h2>Ticket state : <?=$ticket->getEtatTicket()?></h2>
    <h2>Opening date  : <?=$ticket->getDateEmission()->format("Y-m-d H:i:s")?></h2>
    <h2>Last modification  : <?=$dateModification?></h2>
    <h2></h2>
    <h2>Contenue</h2>
    <p class="center ticket-contenue">
        <?php
        $texte = explode("<br>",$ticket->formatContenue());
        foreach ($texte as $t)
        {
            echo htmlspecialchars($t)."<br>";
        }
        ?>
    </p>
    <h2>Réponse</h2>
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
        if ($link != "") echo '<a href="/'.$link.'"  target="_blank"><button class="btn btn-neutral">File number '.$i.'</button></a> <br>';
        $i++;
    }
    ?>
    <a class="center" href="/fr/tickets/<?=$ticket->getIdTicket()?>/repondre/">
        <button class="btn-repondre btn-good">Answer</button>
    </a>
</div>
