<?php
if (empty($_SESSION["auth"]))
{
    header("Location: /pl/connexion");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /pl/401");
    exit();
}

$test = new \Psiko\TestSystem();
$moyenne = $test->getMoyenResult();

?>
<canvas id="myChart" style="height: 50vh"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['Tętno', 'Temperatura skóry', 'Zapamiętywanie kolorowego odcienia', 'Odruch wzrokowy', 'tonalność', 'średnia wyników'] ,
            datasets: [{
                label: 'średnia wyników',
                backgroundColor: 'rgb(7,0,255)',
                borderColor: 'rgb(7,0,255)',
                data: [<?=intval($moyenne["freqCardiaque"])?>,
                    <?=intval($moyenne["temperature"])?>,
                    <?=intval($moyenne["memorisation"])?>,
                    <?=intval($moyenne["memorisation"])?>,
                    <?=intval($moyenne["tonalite"])?>,
                    <?=intval($moyenne["total"])?>]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<table class="table-admin-moyenne-test">
    <thead>
        <th>użytkownik</th>
        <th>Tętno<br></th>
        <th>Temperatura</th>
        <th>Zapamiętywanie</th>
        <th>Odruch wzrokowy</th>
        <th>Rozpoznawanie <br>dźwięku</th>
        <th>Liczba testów</th>
        <th>Zobacz więcej szczegółów</th>
    </thead>
    <tbody>
    <?= $test->tableauRecap("pl"); ?>
    </tbody>
</table>
