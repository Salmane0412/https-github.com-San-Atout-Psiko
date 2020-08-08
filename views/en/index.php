<div id="contenu">
    <div>
        <nav>
            <ul id="menu_utilisateur">
                <li class="menu_deroulant"><a href="projet.html">Our product &ensp;</a>
                    <ul class="sous">
                        <li><a href="#">Course of the tests</a></li>
                        <li><a href = "frequence_cardiaque.html">Heart rate</a></li>
                        <li><a href="#">Skin temperature</a></li>
                    </ul>
                </li>
                <li><a href="#">My Profile <!--(si non connecté, renvoyer sur la page de connexion)--></a></li>
                <li><a href="#">Another navigation tool</a></li>
            </ul>
        </nav>
    </div>

    <section id="presentation">
        <article id="introduction">
            <!--<h1>Bienvenue sur le site de l'entreprise Infinite Measures</h1>-->
            <p>Leader in psychotechnical measurement systems for the assessment of driver and pilot skills. We have developed with Ѱ-CO a revolutionary module to measure and know the skills of future drivers.</p>
            <!--
            <p>C'est ici que vous pourrez créer et vous connecter à votre compte afin d'accéder aux résultats de vos tests psycotechniques. Vous pouvez aussi voir notre projet dans le détail afin de savoir comment fonctionnent chacune de nos fonctionnalités</p>
            -->
        </article>

    </section>
    <p id="plus"><a href="nous.html" title="Qui sommes nous ?">To know more about it</a></p>

    <p class="image"><img  id = "logoInfiniteMeasure"class="logo" src="/Images/logo%20Infinite_measures.png"  title="logo Infinite Measures"/></p>

</div>







<div id = presentationTest>

    <div id = partie1>
        <p>In order to guarantee optimal safety we offer a test to drivers and motorists that will provide different results on your actual capabilities in the field. </p>

        <ul >
            <li> <img class= "logo" src="/Images/logo%20avion.png" title="logo avion"/> </li>
            <li> <img class= "logo" src="/Images/logo%20voiture.png" title="logo voiture"/> </li>
        </ul>
    </div>
    <div id = partie2>
        <p id = description>Description of the tests</p>
        <ul>
            <ul id = partieFrequenceCardiaque>
                <li> <a href = "frequence_cardiaque.html"><img class= "logo" src="/Images/logo freq cardiaque.png" title="logo frequence cardiaque"/></a> </li>
                <ul class = listeTexte><li><a href = "frequence_cardiaque.html"><p class = test>Heart rate</p></a> </li>
                    <li><p class = text>This test is a means of assessing the driver's comfort and stress with regard to his environment when carrying out the various tests.</p></li>
                </ul>

            </ul>
            <ul id = partieTemperaturePeau>
                <li> <a href = "<?= $this->getUrl("temperature fr")?>"><img class= "logo" src="/Images/logo%20temp%C3%A9rature.png" title="logo température peau"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("temperature fr")?>"><p class = test>Skin temperature</p></a></li>
                    <li><p class = text>This test can detect possible diseases, viruses or disorders due to the use of medication.
                            The driver must be in good health and not under the influence of drugs or alcohol.
                            The skin temperature test is carried out in correlation with the heart rate test which will give a good indication of the level of stress and/or health.</p></li>
                </ul>

            </ul>

            <ul id = partieReflexeVisuel>
                <li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>">  <img class= "logo" src="/Images/logo%20reflexe%20visuel.png" title="logo reflex visuel"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>"><p class = test >Visual reflexes</p></a></li>
                    <li><p class = text>This test tests a driver's ability to react to an unusual event.</p></li>
                </ul>

            </ul>

            <ul id = partieReconnaissanceTonalite>
                <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"> <img class= "logo" src="/Images/logo%20test%20auditif.png" title="logo reconnaissance tonalite"/></a> </li>
                <ul class = listeTexte>
                    <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"><p class = test>Tone recognizing</p></a></li>
                    <li>
                        <p class = text>In the event of an accident or failure, the pilot must be able to identify different siren tones, each corresponding to a different failure. (Engine malfunction, or pitot probes)</p>
                    </li>
                </ul>

            </ul>

            <ul id = partieMemorisationCouleur>

                <li><a href = "<?= $this->getUrl("memoire fr")?>"> <img class= "logo" src="/Images/logo%20cerveau.png" title="logo memorisation couleur"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("memoire fr")?>"><p class = test>Colour memory</p></a></li>
                    <li><p class = text>On the road, the driver must be vigilant to the various information (road signs, speed limits, traffic lights, etc.). The colour memory test develops the driver's ability to memorise the events occurring around him.</p></li>
                </ul>

            </ul>

        </ul>
    </div>


</div>