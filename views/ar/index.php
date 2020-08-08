<div id="contenu">
    <div>
        <nav>
            <ul id="menu_utilisateur">
                <li class="menu_deroulant"><a href="projet.html">منتوجنا &ensp;</a>
                    <ul class="sous">
                        <li><a href="#">تسلسل الإختبارات النفسية</a></li>
                        <li><a href = "frequence_cardiaque.html">معدل ضربات القلب</a></li>
                        <li><a href="#"> درجة حرارة الجلد</a></li>
                    </ul>
                </li>
                <li><a href="#">الملف الشخصي <!--(si non connecté, renvoyer sur la page de connexion)--></a></li>
                <li><a href="#">أداة أخرى للتصفح</a></li>
            </ul>
        </nav>
    </div>

    <section id="presentation">
        <article id="introduction">
            <!--<h1>Bienvenue sur le site de l'entreprise Infinite Measures</h1>-->
            <p>شركة رائدة في صناعة وتطوير أجهزة القياس النفسية لتقييم الحالات الجسدية والنفسية للربان الطائرات وسائقي السيارات ولقد طورنا مع شركة "بسي-كو" نموذجا استثنائيا لتمكن من معرفة الحالات النفسية لربان المستقبل</p>
            <!--
            <p>C'est ici que vous pourrez créer et vous connecter à votre compte afin d'accéder aux résultats de vos tests psycotechniques. Vous pouvez aussi voir notre projet dans le détail afin de savoir comment fonctionnent chacune de nos fonctionnalités</p>
            -->
        </article>

    </section>
    <p id="plus"><a href="nous.html" title="Qui sommes nous ?">معرفة المزيد</a></p>

    <p class="image"><img  id = "logoInfiniteMeasure"class="logo" src="/Images/logo%20Infinite_measures.png"  title="logo Infinite Measures"/></p>

</div>







<div id = presentationTest>

    <div id = partie1>
        <p>من أجل ضمان السلامة المثلى نطرح إختبارا للسائيقين وربان الطائرات الذي سيعطي نتائج متعددة على قدراتكم الفعلية في المجال </p>

        <ul >
            <li> <img class= "logo" src="/Images/logo%20avion.png" title="logo avion"/> </li>
            <li> <img class= "logo" src="/Images/logo%20voiture.png" title="logo voiture"/> </li>
        </ul>
    </div>
    <div id = partie2>
        <p id = description>وصف الإختبارات</p>
        <ul>
            <ul id = partieFrequenceCardiaque>
                <li> <a href = "frequence_cardiaque.html"><img class= "logo" src="/Images/logo freq cardiaque.png" title="logo frequence cardiaque"/></a> </li>
                <ul class = listeTexte><li><a href = "frequence_cardiaque.html"><p class = test>معدل ضربات القلب</p></a> </li>
                    <li><p class = text>هذا الإختبار هو عبارة عن طريقة لتقييم مستوى الرخاء و التوتر لدى السائق بالنسبة لمحيطه أثناء القيام بالإختبارات المختلفة </p></li>
                </ul>

            </ul>
            <ul id = partieTemperaturePeau>
                <li> <a href = "<?= $this->getUrl("temperature fr")?>"><img class= "logo" src="/Images/logo%20temp%C3%A9rature.png" title="logo température peau"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("temperature fr")?>"><p class = test>درجة حرارة الجلد</p></a></li>
                    <li><p class = text>هذا الاختبار يمكن من الكشف عن مجموعة من الأمراض أو الفيروسات أو الاضطرابات المحتملة بسبب تناول بعض الأدوية ولهذا يتوجب على السائق أن يكون في صحة جيدة و بدون وجود  تأثير الكحول و المخدرات و هذا ما يقومه به إختبار قياس درجة حرارة الجلد  بالترابط مع إختبار قياس ضربات القلب مما يعطي معرفة تامة بمستوى التوتر أو الصحة</p></li>
                </ul>

            </ul>

            <ul id = partieReflexeVisuel>
                <li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>">  <img class= "logo" src="/Images/logo%20reflexe%20visuel.png" title="logo reflex visuel"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("reflexeVisuel fr")?>"><p class = test >ردة الفعل المرئية</p></a></li>
                    <li><p class = text>هذا الإختبار يتمكن من معرفة قدرة السائق على التعامل مع حدث غير معتاد</p></li>
                </ul>

            </ul>

            <ul id = partieReconnaissanceTonalite>
                <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"> <img class= "logo" src="/Images/logo%20test%20auditif.png" title="logo reconnaissance tonalite"/></a> </li>
                <ul class = listeTexte>
                    <li><a href = "<?= $this->getUrl("reflexeAuditif fr")?>"><p class = test>التعرف على نغمة صوتية</p></a></li>
                    <li>
                        <p class = text>في حالة وجود حادث  أو عطل يتوجب على الطيار أن يكون قادرا على التعرف على مختلف نغمات الطوارئ المتعلقة بكل عطب (عطب المحركات,مقياس الضغط...) </p>
                    </li>
                </ul>

            </ul>

            <ul id = partieMemorisationCouleur>

                <li><a href = "<?= $this->getUrl("memoire fr")?>"> <img class= "logo" src="/Images/logo%20cerveau.png" title="logo memorisation couleur"/> </a></li>
                <ul class = listeTexte><li><a href = "<?= $this->getUrl("memoire fr")?>"><p class = test>تذكر الألوان</p></a></li>
                    <li><p class = text>أثناء القيادة يجب على السائيقين أن يكونوا على أهبة الإستعداد لتلقي مختلف المعلومات( علامات المرور, تحديد السرعة, الأضواء إلخ..) وهذا ما يقيسه إختبار تذكر الألوان حيث يقوي قدرتهم على تذكر الاحداث المحيطة بهم</p></li>
                </ul>

            </ul>

        </ul>
    </div>


</div>