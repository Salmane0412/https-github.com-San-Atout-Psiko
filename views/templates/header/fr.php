<header>
    <!-- contenu de la balise d'en tête-->
    <div class="image_site"> 									<!-- image de l'en-tête-->
        <a href="/Images/infinite_measures_noir_blanc.png"><img src="/Images/miniature_IM_noir_blanc.png" alt="Logo du site" title="Cliquez pour agrandir"/></a>
    </div>

    <nav>														<!--Menu de navigation-->
        <ul id="element_nav_generale">
            <li><a href="<?=$routeur->getUrl("Acceuil fr") ?>">Accueil</a></li>
            <li class="menu_deroulant"><a href="<?=$routeur->getUrl("Nous fr") ?>">Information</a>
                <ul class="sous">
                    <li><a href="<?=$routeur->getUrl("Nous fr") ?>">Le projet</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous fr") ?>">Déroulé des tests</a></li>
                    <li><a href="<?=$routeur->getUrl("frequenceCardiaque fr") ?>">Fréquence cardiaques</a></li>
                    <li><a href="<?=$routeur->getUrl("temperature fr") ?>">Température de la peau</a></li>
                    <li><a href="<?=$routeur->getUrl("reflexeVisuel fr") ?>">Réflexe visuel</a></li>
                    <li><a href="<?=$routeur->getUrl("reflexeAuditif fr") ?>">Reconnaissance de tonalité</a></li>
                    <li><a href="<?=$routeur->getUrl("memoire fr") ?>">Mémorisation de couleurs</a></li>
                </ul>
            </li>
            <li><a href="<?=$routeur->getUrl("FAQ fr") ?>">FAQ</a></li>
            <li><a href="mailto:contact@infinitemeasures.fr">Nous contacter</a></li>
            <?php if(isset($_SESSION["auth"]))
                {
                    if ($_SESSION["auth"]->getRang() === "utilisateur")
                    {
                       $menu = '
                    <li class="menu_deroulant"><a href="#">Menu Utilisateur</a> 
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil fr") .'">Mon profil</a></li>
                            <li><a href="'.$routeur->getUrl("Resultats fr") .'">Mes résultats</a></li>
                            <li><a href="'.$routeur->getUrl("EnvoyerTicket fr") .'">Ecrire un ticket</a></li>
                            <li><a href="'.$routeur->getUrl("MesTickets fr") .'">Mes tickets</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion fr") .'">Déconnexion</a></li>
                        </ul>
                    </li>';
                    }
                    elseif ($_SESSION["auth"]->getRang() === "gestionnaire")
                    {
                        $menu = '
                    <li class="menu_deroulant"><a href="#">Menu Utilisateur</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil fr") .'">Mon profil</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat fr") .'">Consulter les résultats</a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser fr") .'">Administer les utilisateurs</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets fr") .'">Administer les tickets</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ fr") .'">Administer la FAQ</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest fr") .'"> Lancer un test</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion fr") .'">Déconnexion</a></li>
                        </ul>
                    </li>';
                    }
                    elseif ($_SESSION["auth"]->getRang() === "administrateur")
                    {
                        $menu = '
                    <li class="menu_deroulant"><a href="#">Menu Utilisateur</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil fr") .'">Mon profil</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat fr") .'">Consulter les résultats</a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser fr") .'">Administer les utilisateurs</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets fr") .'">Administer les tickets</a></li>
                            <li><a href="'.$routeur->getUrl("AdminEcole fr") .'">Administrer les écoles</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ fr") .'">Administer la FAQ</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest fr") .'"> Lancer un test</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion fr") .'">Déconnexion</a></li>
                        </ul>
                    </li>';
                    }

                    echo $menu;
                }
                else
                {
                    echo '<li class="menu_deroulant"><a href="#">S\'inscrire/ Se connecter &ensp;</a> <!-- &ensp permet de créer un espace double-->
                    <ul class="sous">
                        <li><a href="'.$routeur->getUrl("Inscription fr"). '">Inscription</a></li>
                        <li><a href="'.$routeur->getUrl("Connexion fr") .'">Connexion</a></li>
                    </ul>
                </li>' ;
                }
            ?>
        </ul>
    </nav>

    <div id="langues">											<!-- choix de la langue-->
        <a class="drapeau-link" href="<?=$lienFr?>">
            <img class="drapeau" src="/Images/logo france.png" alt="français" title="Cliquez pour passer le site en français"/>
        </a>
        <a class="drapeau-link" href="<?=$lienEn?>">
            <img class="drapeau" src="/Images/logo angleterre.png" alt="anglais" title="Click here to translate the site in English"/>
        </a>
        <a class="drapeau-link" href="<?=$lienAr?>">
            <img class="drapeau" src="/Images/logo arabe.png" alt="arabe" title="ااضغط هنا لتحويل الموقع إلى العربية "/>
        </a>
        <a class="drapeau-link" href="<?=$lienPl?>">
            <img class="drapeau" src="/Images/logo pologne.png" alt="polonais" title="Kliknij tutaj, aby przejść do strony w języku polskim"/>
        </a>
    </div>
</header>
