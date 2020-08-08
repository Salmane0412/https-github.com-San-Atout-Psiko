<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/tasjildokhol/");
    exit();
}
$userId = $params["id"];
if (($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" ) || ($_SESSION["auth"]->getId() != $userId)) {
    header("Location: /ar/401");
    exit();
}

if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" )
{
    echo '<form class="form-recherche" method="POST" action="">
    <div class="form-group">
        <label for="dateDebut" class="form-control-label">Date de début</label> <br>
        <input id="dateDebut" class="form-control" name="dateDebut" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>
    <div class="form-group">
        <label for="dateFin" class="form-control-label">Date de fin</label> <br>
        <input id="dateFin" class="form-control" name="dateFin" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>

    <button type="submit" class="btn-neutral btn-submit">Rechercher</button>
</form>
';
    if (!empty($_POST)) {
        $userSystem = new \Psiko\UserSystem();
        $resultat = $userSystem->rechercheUser($_POST, "ar", $userId);

    }
}
else
{
    echo '<form class="form-recherche" method="POST" action="">
    <input type="checkbox" name="freqCardiaque" id="freqCardiaque" /> <label for="freqCardiaque">معدل ضربات القلب</label><br />
    <input type="checkbox" name="tempPeau" id="tempPeau" /> <label for="tempPeau">درجة حرارة الجلد</label><br />
    <input type="checkbox" name="reflexeVisuel" id="reflexeVisuel" /> <label for="reflexeVisuel">ردة الفعل المرئية</label><br />
    <input type="checkbox" name="recoTonalite" id="recoTonalite" /> <label for="recoTonalite">التعرف على تغمة صوتية</label><br />
    <input type="checkbox" name="memoCouleur" id="memoCouleur" /> <label for="memoCouleur">تذكر الألوان</label><br />


    <div class="form-group">
        <label for="dateDebut" class="form-control-label">تاريخ البداية</label> <br>
        <input id="dateDebut" class="form-control" name="dateDebut" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>
    <div class="form-group">
        <label for="dateFin" class="form-control-label">Date de fin</label> <br>
        <input id="dateFin" class="form-control" name="dateFin" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>

    <button type="submit" class="btn-neutral btn-submit">ابحث</button>
</form>
';
    if (!empty($_POST)) {
        $userSystem = new \Psiko\UserSystem();
        $resultat = $userSystem->rechercheAdmin($_POST, "ar", $userId);

    }
}
?>


<script type="text/javascript" src="/JS/charte.bundle.js"></script>
    <h1>النتائج المبيانية للإختبار النفسي</h1>
    <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;border-radius:20px;"></canvas>

    <script>
        var ctx = document.getElementById("chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {


                labels: [<?=$resultat["dateExamen"] ?>],

                datasets:
                    [{
                        label: 'Fréquence Cardiaque ',
                        data: [<?=$resultat["freqCardiaque"] ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },

                        {
                            label: 'Température de la peau',
                            data: [<?=$resultat["tempPeau"] ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(255,204,153)',
                            borderWidth: 3
                        },
                        {
                            label: 'Mémorisation d\'une teinte colorée ',
                            data: [<?=$resultat["memoCouleur"]?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(0,255,255)',
                            borderWidth: 3
                        },
                        {
                            label: 'Réflexes visuels',
                            data: [<?=$resultat["reflexeVisuel"] ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(153, 255, 102)',
                            borderWidth: 3
                        },
                        {
                            label: 'Tonalité',
                            data: [<?=$resultat["recoTonalite"] ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(128, 128, 0)',
                            borderWidth: 3
                        },
                    ]
            },

            options: {
                scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                tooltips:{mode: 'index'},
                legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
            }
        });
    </script>
