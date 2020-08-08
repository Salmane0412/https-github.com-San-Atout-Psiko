<header>
    <!-- contenu de la balise d'en tête-->
    <div class="image_site">                                    <!-- image de l'en-tête-->
        <a href="/Images/infinite_measures_noir_blanc.png"><img src="/Images/miniature_IM_noir_blanc.png" alt="Logo du site" title="Click to enlarge"/></a>
    </div>

    <nav>                                                       <!--Menu de navigation-->
        <ul id="element_nav_generale">
            <li><a href="<?=$routeur->getUrl("Acceuil en") ?>">Home page</a></li>
            <li class="menu_deroulant"><a href="<?=$routeur->getUrl("Nous en") ?>">Informations</a>
                <ul class="sous">
                    <li><a href="<?=$routeur->getUrl("Nous en") ?>">Who are we?</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous en") ?>">The Project</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous en") ?>">Course of the tests</a></li>
                    <li><a href="<?=$routeur->getUrl("frequenceCardiaque en") ?>">Heart rate</a></li>
                    <li><a href="<?=$routeur->getUrl("temperature en") ?>">Skin temperature</a></li>

                </ul>
            </li>
            <li><a href="<?=$routeur->getUrl("FAQ en") ?>">Q/A</a></li>
            <li><a href="<?=$routeur->getUrl("NousContacter en") ?>">Contact us</a></li>
            <?php if(isset($_SESSION["auth"]))
            {
                if ($_SESSION["auth"]->getRang() === "utilisateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">User Menu</a> 
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil en") .'">My profile</a></li>
                            <li><a href="'.$routeur->getUrl("Resultats en") .'">My results</a></li>
                            <li><a href="'.$routeur->getUrl("EnvoyerTicket en") .'">Write a ticket</a></li>
                            <li><a href="'.$routeur->getUrl("MesTickets en") .'">My tickets</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion en") .'">Disconnect</a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "gestionnaire")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">User Menu</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil en") .'">My profile</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat en") .'">Check results</a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser en") .'">Administrate users</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets en") .'">Administrate tickets</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ en") .'">Administrate Q/A</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest en") .'"> Launch test</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion en") .'">Disconnect</a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "administrateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">User Menu</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil en") .'">My profile</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat en") .'">Check results</a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser en") .'">Administrate users</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets en") .'">Administrate tickets</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ en") .'">Administrate Q/A</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest en") .'"> Launch test</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion en") .'">Disconnect</a></li>
                        </ul>
                    </li>';
                }

                echo $menu;
            }
            else
            {
                echo '<li class="menu_deroulant"><a href="#">Sign in/ Sign up &ensp;</a> <!-- &ensp permet de créer un espace double-->
                    <ul class="sous">
                        <li><a href="'.$routeur->getUrl("Inscription en"). '">Sign in</a></li>
                        <li><a href="'.$routeur->getUrl("Connexion en") .'">Sign up</a></li>
                    </ul>
                </li>' ;
            }
            ?>
        </ul>
    </nav>

    <div id="langues">                                          <!-- choix de la langue-->
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