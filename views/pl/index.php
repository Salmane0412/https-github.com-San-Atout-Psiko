<div id="contenu">
    <section id="presentation">
        <article id="introduction">
            <!--<h1>Bienvenue sur le site de l'entreprise Infinite Measures</h1>-->
            <p>Lider w psychotechnicznych systemach pomiarowych do oceny umiejętności kierowców i pilotów. Opracowaliśmy z Ѱ-CO rewolucyjny moduł do mierzenia i poznawania umiejętności przyszłych pilotów.</p>
            <!--
            <p>C'est ici que vous pourrez créer et vous connecter à votre compte afin d'accéder aux résultats de vos tests psycotechniques. Vous pouvez aussi voir notre projet dans le détail afin de savoir comment fonctionnent chacune de nos fonctionnalités</p>
            -->
        </article>

    </section>
    <p id="plus"><a href="nous.html" title="Qui sommes nous ?">Dowiedz się więcej</a></p>

    <p class="image"><img  id = "logoInfiniteMeasure"class="logo" src="/Images/logo%20Infinite_measures.png"  title="logo Infinite Measures"/></p>

</div>







<div id = presentationTest>

    <div id = partie1>
        <p>Aby zagwarantować optymalne bezpieczeństwo, oferujemy kierowcom i pilotom test, który zapewni różne wyniki w zakresie rzeczywistej wydajności w terenie. </p>

        <ul >
            <li> <img class= "logo" src="/Images/logo%20avion.png" title="logo avion"/> </li>
            <li> <img class= "logo" src="/Images/logo%20voiture.png" title="logo voiture"/> </li>
        </ul>
    </div>
    <div id = partie2>
        <p id = description>Opis testów</p>
        <ul>
            <ul id = partieFrequenceCardiaque>
                <li> <a href = "frequence_cardiaque.html"><img class= "logo" src="/Images/logo freq cardiaque.png" title="logo frequence cardiaque"/></a> </li>
                <ul class = listeTexte><li><a href = "frequence_cardiaque.html"><p class = test>Tętno</p></a> </li>
                    <li><p class = text>Ten test jest sposobem oceny komfortu i stresu kierowcy w odniesieniu do jego otoczenia podczas różnych testów.</p></li>
                </ul>

            </ul>
            <ul id = partieTemperaturePeau>
                <li> <a href = "<?= $this->getUrl("temperature pl")?>"><img class= "logo" src="/Images/logo%20temp%C3%A9rature.png" title="logo température peau"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("temperature pl")?>"><p class = test>Temperatura skóry </p></a></li>
                    <li><p class = text>Ten test może wykryć możliwe choroby, wirusy lub zaburzenia związane z przyjmowaniem leków. 
                    W rzeczywistości kierowca musi być w dobrym zdrowiu, a nie pod wpływem narkotyków lub alkoholu. 
                    Test temperatury skóry jest przeprowadzany w korelacji z częstością akcji serca, co daje dobre wskazanie poziomu stresu i / lub zdrowia.</p></li>
                </ul>

            </ul>

            <ul id = partieReflexeVisuel>
                <li><a href = "<?= $this->getUrl("reflexeVisuel pl")?>">  <img class= "logo" src="/Images/logo%20reflexe%20visuel.png" title="logo reflex visuel"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("reflexeVisuel pl")?>"><p class = test >Odruch wzrokowy</p></a></li>
                    <li><p class = text>Ten test sprawdza zdolność kierowcy do reagowania na niecodzienne zdarzenie.</p></li>
                </ul>

            </ul>

            <ul id = partieReconnaissanceTonalite>
                <li><a href = "<?= $this->getUrl("reflexeAuditif pl")?>"> <img class= "logo" src="/Images/logo%20test%20auditif.png" title="logo reconnaissance tonalite"/></a> </li>
                <ul class = listeTexte>
                    <li><a href = "<?= $this->getUrl("reflexeAuditif pl")?>"><p class = test>Rozpoznawanie tonów</p></a></li>
                    <li>
                        <p class = text>W razie wypadku lub awarii pilot musi być w stanie rozpoznać różne dźwięki syreny, z których każdy odpowiada innej awarii. (Awaria silników lub sond Pitota)</p>
                    </li>
                </ul>

            </ul>

            <ul id = partieMemorisationCouleur>

                <li><a href = "<?= $this->getUrl("memoire pl")?>"> <img class= "logo" src="/Images/logo%20cerveau.png" title="logo memorisation couleur"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("memoire pl")?>"><p class = test>Zapamiętywanie kolorów</p></a></li>
                    <li><p class = text>Podczas podróży kierowca musi zwracać uwagę na różne informacje (znak drogowy, ograniczenia prędkości, światła itp.). Test zapamiętywania kolorów pozwala w tym sensie rozwinąć jego zdolność do zapamiętywania wydarzeń wokół niego. .</p></li>
                </ul>

            </ul>

        </ul>
    </div>


</div>