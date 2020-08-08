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
    <h1><?=$ticket->getIdTicket()?>: <?= htmlspecialchars($ticket->getTitre())?> الطلب</h1>
    <br>
    <h2>  <?= $ticket->getCible()?> المستهدف:</h2>
    <h2> <?=$ticket->getNiveauProblem()?> مستوى المعضلة:</h2>
    <h2> <?=$ticket->getEtatTicket()?> حالة الطلب :</h2>
    <h2> <?=$ticket->getDateEmission()->format("Y-m-d H:i:s")?> تاريخ الفتح :</h2>
    <h2> <?=$dateModification?> تاريخ آخر تحديث:</h2>
    <h2></h2>
    <h2>المحتوى</h2>
    <p class="center ticket-contenue">
        <?php
        $texte = explode("<br>",$ticket->formatContenue());
        foreach ($texte as $t)
        {
            echo htmlspecialchars($t)."<br>";
        }
        ?>
    </p>
    <h2>جواب</h2>
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
        if ($link != "") echo '<a href="/'.$link.'"  target="_blank"><button class="btn btn-neutral"> '.$i.'الملف رقم</button></a> <br>';
        $i++;
    }
    if (!$ticket->isArchive())
    {
        echo '<a class="center" href="/ar/admin/talabat/'.$ticketId.'/tabdil-mostawa-lmochkil/">
            <button class="btn-repondre btn-neutral">تغيير مستوى المعضلة</button>
        </a>';
        if ($_SESSION["auth"]->getRang() != "administrateur")
        {
            echo "<a class=\"center\" href=''>
        <button class=\"btn-repondre btn-negatif\">إرسال للمدير</button>
    </a>";
        }


        echo '<a class="center" href="/ar/modir/talabat/'.$ticketId.'/ajib/">
        <button class="btn-repondre btn-good">أضــف جوابا</button>
    </a>';
    }
    ?>
</div>
