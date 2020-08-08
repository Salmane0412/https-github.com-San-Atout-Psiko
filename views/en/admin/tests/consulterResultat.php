<?php
if (empty($_SESSION["auth"]))
{
    header("Location: /en/connexion");
    exit();
}
if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire")
{
    header("Location: /en/401");
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
            labels: ['Frequence cardiaque', 'Temperature de la peau', 'Memorisation d\'une teinte colorée', 'Reflexe visuel', 'tonalité', 'moyenne des résultats'] ,
            datasets: [{
                label: 'Moyenne des résultats',
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
        <th>User</th>
        <th>Heart beats</th>
        <th>Temperature</th>
        <th>Memorisation</th>
        <th>Visual reflexes</th>
        <th>Tone recognizing</th>
        <th>Number of tests done</th>
        <th>See more details</th>
    </thead>
    <tbody>
    <?= $test->tableauRecap("en"); ?>
    </tbody>
</table>
