
<header>
    <!-- contenu de la balise d'en tête-->
    <div class="image_site"> 									<!-- image de l'en-tête-->
        <a href="/Images/infinite_measures_noir_blanc.png"><img src="/Images/miniature_IM_noir_blanc.png" alt="Logo du site" title="اضغط هنا لتكيبر الصورة"/></a>
    </div>

    <nav>														<!--Menu de navigation-->
        <ul id="element_nav_generale">
            <li><a href="<?=$routeur->getUrl("Acceuil ar") ?>">الإستقبال</a></li>
            <li class="menu_deroulant"><a href="<?=$routeur->getUrl("Nous ar") ?>">معلومات</a>
                <ul class="sous">
                    <li><a href="<?=$routeur->getUrl("Nous ar") ?>">من نحن </a></li>
                    <li><a href="<?=$routeur->getUrl("Nous ar") ?>">المشروع</a></li>
                    <li><a href="<?=$routeur->getUrl("Nous ar") ?>">تسلسل الإختبارات</a></li>
                    <li><a href="<?=$routeur->getUrl("frequenceCardiaque ar") ?>">معدل ضربات القلب </a></li>
                    <li><a href="<?=$routeur->getUrl("temperature ar") ?>">درجة حرارة الجلد</a></li>

                </ul>
            </li>
            <li><a href="<?=$routeur->getUrl("FAQ ar") ?>">FAQ</a></li>
            <li><a href="<?=$routeur->getUrl("NousContacter ar") ?>">اتصل بنا</a></li>
            <?php if(isset($_SESSION["auth"]))
            {
                if ($_SESSION["auth"]->getRang() === "utilisateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">قائمة المستخدم</a> 
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil ar") .'">ملفي الشخصي</a></li>
                            <li><a href="'.$routeur->getUrl("Resultats ar") .'">نتائجي</a></li>
                            <li><a href="'.$routeur->getUrl("EnvoyerTicket ar") .'">كتابة طلب</a></li>
                            <li><a href="'.$routeur->getUrl("MesTickets ar") .'">طلاباتي</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion ar") .'">تسجيل الخروج</a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "gestionnaire")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">قائمة المستخدم</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil ar") .'">ملفي الشخصي</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat ar") .'">زيارة النتائج </a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser ar") .'">إدارة المستخدمين</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets ar") .'">إدارة الطلبات</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ ar") .'">إدارة الأسئلة الشائعة</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest ar") .'"> إطلاق الإختبار</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion ar") .'">تسجيل الخروج</a></li>
                        </ul>
                    </li>';
                }
                elseif ($_SESSION["auth"]->getRang() === "administrateur")
                {
                    $menu = '
                    <li class="menu_deroulant"><a href="#">قائمة المستخدم</a> <!-- &ensp permet de créer un espace double-->
                        <ul class="sous">
                            <li><a href="'.$routeur->getUrl("Profil ar") .'">ملفي الشخصي</a></li>
                            <li><a href="'.$routeur->getUrl("AdminResultat ar") .'">زيارة النتائج</a></li>
                            <li><a href="'.$routeur->getUrl("AdminUser ar") .'">إدارة المستخدمين</a></li>
                            <li><a href="'.$routeur->getUrl("AdminTickets ar") .'">إدارة الطلبات</a></li>
                            <li><a href="'.$routeur->getUrl("AdminFAQ ar") .'">إدارة الأسئلة الشائعة</a></li>
                            <li><a href="'.$routeur->getUrl("LancerUnTest ar") .'"> إطلاق الإختبار</a></li>
                            <li><a href="'.$routeur->getUrl("Deconnexion ar") .'">تسجيل الخروج</a></li>
                        </ul>
                    </li>';
                }

                echo $menu;
            }
            else
            {
                echo '<li class="menu_deroulant"><a href="#">التسجيل/ الإتصال &ensp;</a> <!-- &ensp permet de créer un espace double-->
                    <ul class="sous">
                        <li><a href="'.$routeur->getUrl("Inscription ar"). '">التسجيل</a></li>
                        <li><a href="'.$routeur->getUrl("Connexion ar") .'">تسجيل الدخول</a></li>
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
            <img class="drapeau" src="/Images/logo arabe.png" alt="arabe" title="اضغط هنا للمرور إلى اللغة العربية "/>
        </a>
        <a class="drapeau-link" href="<?=$lienPl?>">
            <img class="drapeau" src="/Images/logo pologne.png" alt="polonais" title="Kliknij tutaj, aby przejść do strony w języku polskim"/>
        </a>
    </div>
</header>


