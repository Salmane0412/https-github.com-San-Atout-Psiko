<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
$userId = $params["id"];
if (($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" ) || ($_SESSION["auth"]->getId() != $userId)) {
    header("Location: /pl/401");
    exit();
}

if ($_SESSION["auth"]->getRang() != "administrateur" && $_SESSION["auth"]->getRang() != "gestionnaire" )
{
    echo '<form class="form-recherche" method="POST" action="">
    <div class="form-group">
        <label for="dateDebut" class="form-control-label"> Data rozpoczęcia </label> <br>
        <input id="dateDebut" class="form-control" name="dateDebut" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>
    <div class="form-group">
        <label for="dateFin" class="form-control-label"> Data końca /label> <br>
        <input id="dateFin" class="form-control" name="dateFin" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>

    <button type="submit" class="btn-neutral btn-submit">Szukaj</button>
</form>
';
    if (!empty($_POST)) {
        $userSystem = new \Psiko\UserSystem();
        $resultat = $userSystem->rechercheUser($_POST, "pl", $userId);

    }
}
else
{
    echo '<form class="form-recherche" method="POST" action="">
    <input type="checkbox" name="freqCardiaque" id="freqCardiaque" /> <label for="freqCardiaque">Tętno</label><br />
    <input type="checkbox" name="tempPeau" id="tempPeau" /> <label for="tempPeau">Temperatura skóry</label><br />
    <input type="checkbox" name="reflexeVisuel" id="reflexeVisuel" /> <label for="reflexeVisuel">Odruchy wzrokowe</label><br />
    <input type="checkbox" name="recoTonalite" id="recoTonalite" /> <label for="recoTonalite">Rozpoznawanie tonów</label><br />
    <input type="checkbox" name="memoCouleur" id="memoCouleur" /> <label for="memoCouleur">Pamięć kolorów</label><br />


    <div class="form-group">
        <label for="dateDebut" class="form-control-label">Data rozpoczęcia</label> <br>
        <input id="dateDebut" class="form-control" name="dateDebut" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>
    <div class="form-group">
        <label for="dateFin" class="form-control-label">Data końca </label> <br>
        <input id="dateFin" class="form-control" name="dateFin" value="'.date("Y-m-d").'" min="2020-1-1" max="2100-1-1" type="date">
    </div>

    <button type="submit" class="btn-neutral btn-submit">Szukaj</button>
</form>
';
    if (!empty($_POST)) {
        $userSystem = new \Psiko\UserSystem();
        $resultat = $userSystem->rechercheAdmin($_POST, "fr", $userId);

    }
}
?>


<script type="text/javascript" src="/JS/charte.bundle.js"></script>
    <h1> Graficzne wyniki psychotechnicznych testów pomiarowych</h1>
    <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;border-radius:20px;"></canvas>

    <script>
        var ctx = document.getElementById("chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {


                labels: [<?=$resultat["dateExamen"] ?>],

                datasets:
                    [{
                        label: ' Tętno ',
                        data: [<?=$resultat["freqCardiaque"] ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },

                        {
                            label: 'Temperatura skóry',
                            data: [<?=$resultat["tempPeau"] ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(255,204,153)',
                            borderWidth: 3
                        },
                        {
                            label: 'Zapamiętywanie kolorowego odcienia ',
                            data: [<?=$resultat["memoCouleur"]?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(0,255,255)',
                            borderWidth: 3
                        },
                        {
                            label: 'Odruchy wzrokowe',
                            data: [<?=$resultat["reflexeVisuel"] ?>],
                            backgroundColor: 'transparent',
                            borderColor:'rgba(153, 255, 102)',
                            borderWidth: 3
                        },
                        {
                            label: 'tonalność',
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
