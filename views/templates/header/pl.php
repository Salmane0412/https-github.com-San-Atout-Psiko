<header>
    <!-- contenu de la balise d'en tête-->
    <div class="image_site"> 									<!-- image de l'en-tête-->
        <a href="/Images/infinite_measures_noir_blanc.png"><img src="/Images/miniature_IM_noir_blanc.png" alt="Logo du site" title="Kliknij, aby powiększyć"/></a>
    </div>

    <nav>														<!--Menu de navigation-->
        <ul id="element_nav_generale">
            <li><a href="<?=$routeur->getUrl("Acceuil pl") ?>">Strona domowa</a></li>
            <li class="menu_deroulant"><a href="<?=$routeur->getUrl("Nous pl") ?>">Informacja</a>
                <ul class="sous">
                    <li><a href="<?=$routeur->getUrl("Nous pl") ?>">Kim jesteśmy</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous pl") ?>">Nasz Projekt</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous pl") ?>">Przeprowadzanie testów</a></li>
                    <li><a href="<?=$routeur->getUrl("frequenceCardiaque pl") ?>">Tętno</a></li>
                    <li><a href="<?=$routeur->getUrl("temperature pl") ?>">Temperatura skóry</a></li>

                </ul>
            </li>
            <li><a href="<?=$routeur->getUrl("FAQ pl") ?>">FAQ</a></li>
            <li><a href="<?=$routeur->getUrl("NousContacter pl") ?>">Skontaktuj się z nami</a></li>
            <?php if(isset($_SESSION["auth"]))
            {
                if ($_SESSION["auth"]->getRang() === "utilisateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#"> Menu użytkownika </a> 
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil pl") .'"> Mój profil </a></li>
                            <li><a href="'.$routeur->getUrl("Resultats pl") .'"> Moje wyniki </a></li>
                            <li><a href="'.$routeur->getUrl("EnvoyerTicket pl") .'"> Napisz bilet </a></li>
                            <li><a href="'.$routeur->getUrl("MesTickets pl") .'"> Moje bilety </a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion pl") .'"> Wyloguj </a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "gestionnaire")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">Menu zarządzający</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil pl") .'"> Mój profil </a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat pl") .'"> Sprawdź wyniki </a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser pl") .'"> Administruj użytkownicy </a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets pl") .'"> Administruj bilety </a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ pl") .'"> Administruj FAQ </a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest pl") .'"> Rozpocznij test </a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion pl") .'"> Wyloguj </a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "administrateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">Menu Administratora</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil pl") .'"> Mój profil </a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat pl") .'"> Sprawdź wyniki </a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser pl") .'"> Administruj użytkownicy  </a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets pl") .'"> Administruj bilety </a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ pl") .'"> Administruj FAQ </a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest pl") .'"> Rozpocznij test </a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion pl") .'"> Wyloguj </a></li>
                        </ul>
                    </li>';
                }

                echo $menu;
            }
            else
            {
                echo '<li class="menu_deroulant"><a href="#"> Zarejestruj się / Zaloguj się &ensp;</a> <!-- &ensp permet de créer un espace double-->
                    <ul class="sous">
                        <li><a href="'.$routeur->getUrl("Inscription pl"). '"> Rejestracja </a></li>
                        <li><a href="'.$routeur->getUrl("Connexion pl") .'"> Zaloguj się </a></li>
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
