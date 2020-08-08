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
    <h2>Poziom problemu: <?=$ticket->getNiveauProblem()?></h2>
    <h2>Status biletu: <?=$ticket->getEtatTicket()?></h2>
    <h2>Data otwarcia: <?=$ticket->getDateEmission()->format("Y-m-d H:i:s")?></h2>
    <h2>Data ostatniej modyfikacji: <?=$dateModification?></h2>
    <h2></h2>
    <h2>zawartość</h2>
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
        if ($link != "") echo '<a href="/'.$link.'"  target="_blank"><button class="btn btn-neutral">Numer pliku'.$i.'</button></a> <br>';
        $i++;
    }
    if (!$ticket->isArchive())
    {
        echo '<a class="center" href="/pl/admin/tickets/'.$ticketId.'/changer-niveau-probleme/">
            <button class="btn-repondre btn-neutral">Zmień poziom problemu</button>
        </a>';
        if ($_SESSION["auth"]->getRang() != "administrateur")
        {
            echo "<a class=\"center\" href=''>
        <button class=\"btn-repondre btn-negatif\">Wyślij do administratorów</button>
    </a>";
        }


        echo '<a class="center" href="/pl/admin/tickets/'.$ticketId.'/repondre/">
        <button class="btn-repondre btn-good">Dodaj odpowiedź</button>
    </a>';
    }
    ?>
</div>
