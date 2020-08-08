<div id="contenu">
    <section id="presentation">
        <article id="introduction">
            <!--<h1>Bienvenue sur le site de l'entreprise Infinite Measures</h1>-->
            <p>Leader dans les systèmes de mesures psychotechniques pour l'évaluation des aptitudes des conducteurs et des pilotes. Nous avons développé avec Ѱ-CO un module révolutionnaire afin de permettre de mesurer et connaître les aptitudes des futurs pilotes.</p>
            <!--
            <p>C'est ici que vous pourrez créer et vous connecter à votre compte afin d'accéder aux résultats de vos tests psycotechniques. Vous pouvez aussi voir notre projet dans le détail afin de savoir comment fonctionnent chacune de nos fonctionnalités</p>
            -->
        </article>

    </section>
    <p id="plus"><a href="/fr/nous/" title="Qui sommes nous ?">En savoir plus</a></p>

    <p class="image"><img  id = "logoInfiniteMeasure"class="logo" src="/Images/logo%20Infinite_measures.png"  title="logo Infinite Measures"/></p>

</div>







<div id = presentationTest>

    <div id = partie1>
        <p>Afin de garantir une sécurité optimale nous proposons un test aux automobiliste et aux pilotes qui fournira différents résultats sur vos capacités effective sur le terrain. </p>

        <ul >
            <li> <img class= "logo" src="/Images/logo%20avion.png" title="logo avion"/> </li>
            <li> <img class= "logo" src="/Images/logo%20voiture.png" title="logo voiture"/> </li>
        </ul>
    </div>
    <div id = partie2>
        <p id = description>Description des tests</p>
        <ul>
            <ul id = partieFrequenceCardiaque>
                <li> <a href = "frequence_cardiaque.html"><img class= "logo" src="/Images/logo freq cardiaque.png" title="logo frequence cardiaque"/></a> </li>
                <ul class = listeTexte><li><a href = "frequence_cardiaque.html"><p class = test>Fréquence cardiaque</p></a> </li>
                    <li><p class = text>Ce test est un moyen d’évaluer l’aisance et le stress du conducteur quant à son environnement  lors de la réalisation des différents tests.</p></li>
                </ul>

            </ul>
            <ul id = partieTemperaturePeau>
                <li> <a href = "<?= $this->getUrl("temperature fr")?>"><img class= "logo" src="/Images/logo%20temp%C3%A9rature.png" title="logo température peau"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("temperature fr")?>"><p class = test>Température de la peau</p></a></li>
                    <li><p class = text>Ce test permet de déceler d’éventuels maladies, virus ou troubles du à la prise de médicaments.
                            En effet le conducteur doit être en bonne santé et sous aucune emprise de drogue ou d’alcool.
                            Le test de température de la peau est réalisé en corrélation avec celui de la fréquence cardiaque ce qui donnera une bonne indication sur le niveau de stress et/ ou de santé.</p></li>
                </ul>

            </ul>

            <ul id = partieReflexeVisuel>
                <li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>">  <img class= "logo" src="/Images/logo%20reflexe%20visuel.png" title="logo reflex visuel"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>"><p class = test >Réflexe visuel</p></a></li>
                    <li><p class = text>Ce test permet de Tester la capacité d’un conducteur à réagir à un évènement inhabituel.</p></li>
                </ul>

            </ul>

            <ul id = partieReconnaissanceTonalite>
                <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"> <img class= "logo" src="/Images/logo%20test%20auditif.png" title="logo reconnaissance tonalite"/></a> </li>
                <ul class = listeTexte>
                    <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"><p class = test>Reconnaissance de tonalité</p></a></li>
                    <li>
                        <p class = text>En cas d’accident ou de panne le pilote doit pouvoir identifier différentes tonalités de sirènes qui correspondent chacune à une panne différente. (Dysfonctionnement des moteurs, ou sondes pitot)</p>
                    </li>
                </ul>

            </ul>

            <ul id = partieMemorisationCouleur>

                <li><a href = "<?= $this->getUrl("memoire fr")?>"> <img class= "logo" src="/Images/logo%20cerveau.png" title="logo memorisation couleur"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("memoire fr")?>"><p class = test>Mémorisation de couleurs</p></a></li>
                    <li><p class = text>En cours de routes, le conducteurs doit être vigilant aux différentes informations (panneau de signalisations, limitations de vitesse, feux etc..) le test de mémorisation de couleurs permet en ce sens de  développer sa capacité à mémoriser les évènements se produisant autour de lui.</p></li>
                </ul>

            </ul>

        </ul>
    </div>


</div>