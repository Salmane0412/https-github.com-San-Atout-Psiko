<?php


namespace Psiko\helper;


class Notification
{
    public static function errorNotifPasswordMissMatch($langue)
    {
        if ($langue === "fr") $result = "Les mots de passes ne sont pas les mêmes";
        else if ($langue === "ar") $result = "كلامات المرور لا يتشبهان ";
        else if ($langue === "pl") $result = "Hasła nie są takie same";
        else                       $result = "Passwords are differents";
        return $result ;
    }

    public static function errorNotifTooYoung($langue)
    {
        if ($langue === "fr") $result = "Vous êtes trop jeunes âge minimum (16 ans)";
        else if ($langue === "ar") $result = "مازلت صغيرا فالعمر الأدنى هو 16 عاما";
        else if ($langue === "pl") $result = "Jesteś za młody, minimalny wiek (16 lat)";
        else                       $result = "You are too young. Required age is above 16.";
        return $result ;
    }

    public static function errorNotifAllReadyIn($langue)
    {
        if ($langue === "fr") $result = "L'utilisateur est déjà présent dans la base de données";
        else if ($langue === "ar") $result = "المستخدم يوجد مسبقا في قاعدة البيانات";
        else if ($langue === "pl") $result = "Użytkownik jest już obecny w bazie danych";
        else                       $result = "User is already in database";
        return $result ;
    }

    public static function errorNotifUserNotFoubnd($langue)
    {
        if ($langue === "fr") $result = "L'utilisateur n'as pas été trouvé dans la base de données";
        else if ($langue === "ar") $result = "لم يتم العثور على المستخدم في قاعدة البيانات";
        else if ($langue === "pl") $result = "Nie znaleziono użytkownika w bazie danych";
        else                       $result = "This user could not be found in database";
        return $result ;
    }

    public static function errorNotifWrongPassword($langue)
    {
        if ($langue === "fr") $result = "le mail et le mots de passe ne corresponde pas";
        else if ($langue === "ar") $result = "لا يتطابق البريد الإلكتروني مع كلمة المرور";
        else if ($langue === "pl") $result = "Adres e-mail i hasło nie są zgodne";
        else                       $result = "Email and password do not correspond";

        return $result ;
    }

    public static function errorExtensionNotSupported($langue)
    {
        if ($langue === "fr")      $result = "L'extension n'est pas autorisé";
        else if ($langue === "ar") $result = "لا يتطابق البريد الإلكتروني مع كلمة المرور";

        else if ($langue === "pl") $result = "";
        else                       $result = "Extension not supported";
        return $result ;
    }

    public static function errorFileTropLourd($langue, $depassement)
    {
        if ($langue === "fr")      $result = "Nous sommes désolé mais votre fichier dépasse la limite de ".$depassement. " Ko";
        else if ($langue === "ar") $result = "كيلوبايت".$depassement. "نتأسف ملفك تجاوز الحد المحدد في ";
        else if ($langue === "pl") $result = "Przepraszamy, ale plik przekracza limit ".$depassement. " Kb";
        else                       $result = "Your file is too heavy ($depassement Ko)";
        return $result ;
    }

    public static function errorUploadFiles($langue)
    {
        if ($langue === "fr")      $result = "Une erruer est arrivé durant l'upload du fichier";
        else if ($langue === "ar") $result = "حدث خطأ أثناء تحميل الملف";
        else if ($langue === "pl") $result = "Wystąpił błąd podczas przesyłania pliku";
        else                       $result = "An unexpected error happened during upload";
        return $result ;
    }

    public static function successAddNewQuestion(String $langue)
    {
        if ($langue === "fr")      $result = "La question a bien été ajouté à la FAQ !";
        else if ($langue === "ar") $result = "تم إضافة السؤال إلى مجوعة الأسئلة الشائعة بنجاح";
        else if ($langue === "pl") $result = "Pytanie zostało dodane do FAQ!";
        else                       $result = "Question added to the Q/A with success";

        return $result ;
    }

    public static function errorAddNewQuestion(String $langue)
    {
        if ($langue === "fr")      $result = "Un problème est apparu durant l'ajout de la question...";
        else if ($langue === "ar") $result = "...حدث خطأ أثناء إضافة السؤال";
        else if ($langue === "pl") $result = "Podczas dodawania pytania pojawił się problem ...";
        else                       $result = "Something wrong happened during the adding of the question";
        return $result ;
    }

    public static function successUpdateFAQ(string $langue)
    {
        if ($langue === "fr")      $result = "La modification de la question a bien été effectué ";
        else if ($langue === "ar") $result = "تم تعديل السؤال بنجاح";
        else if ($langue === "pl") $result = "Dokonano modyfikacji pytania";
        else                       $result = "Question modified successfully";
        return $result ;
    }

    public static function errorUpdateFAQ(string $langue)
    {
        if ($langue === "fr")      $result = "Une erreur est intervenu dans le processus de modification de la question";
        else if ($langue === "ar") $result = "حدث خطأ في سيرورة تعديل السؤال";
        else if ($langue === "pl") $result = "Wystąpił błąd podczas modyfikowania pytania";
        else                       $result = "An error happened during the modifying process";
        return $result ;
    }

    public static function successDeconnexion($langue)
    {
        if ($langue === "fr")      $result = "Vous avez bien été déconnecté";
        else if ($langue === "ar") $result = "لقد تم تسجيل الخروج";
        else if ($langue === "pl") $result = "Zostałeś rozłączony";
        else                       $result = "you have been disconnected";
        return $result ;
    }

    public static function successLogIn($langue)
    {
        //TODO faire les trads pour le success de la connexion polonais / arabes / anglais
        if ($langue === "fr")      $result = "Vous êtes maintenant connecté";
        else if ($langue === "ar") $result = "لقد تم تسجيل الدخول";
        else if ($langue === "pl") $result = "Jesteś teraz połączony";
        else                       $result = "You are now online";
        return $result ;
    }

    public static function successChangeEmail($langue)
    {
        //TODO faire les trads pour successChangeEmail polonais / arabes / anglais
        if ($langue === "fr")      $result = "Votre adresse email a bien été changé";
        else if ($langue === "ar") $result = "لقد تم تغيير بريدك الإلكتروني";
        else if ($langue === "pl") $result = "Twój adres e-mail został zmieniony";
        else                       $result = "Email changed successfully";
        return $result ;
    }

    public static function errorEmailAllReadyExist($langue)
    {
        //TODO faire les trads pour errorEmailAllReadyExist polonais / arabes / anglais
        if ($langue === "fr")      $result = "Cette email est déjà utilisé merci d'en choisir un autre";
        else if ($langue === "ar") $result = "تم إختيار هذا البريد الاكتروني مسبقا اعد إختيار بريد أخر";
        else if ($langue === "pl") $result = "";
        else                       $result = "This email adress is already used. Please try another one.";
        return $result ;
    }

    public static function warningSameSexe(string $langue)
    {
        //TODO faire les trads pour le success de la connexion polonais / arabes / anglais
        if ($langue === "fr")      $result = "Aucun changement dans le sexe detecté";
        else if ($langue === "ar") $result = "لم نرصد أي تغيير في الجنس";
        else if ($langue === "pl") $result = "";
        else                       $result = "No change of sex detected";
        return $result ;
    }

    public static function sucessChangement(string $langue)
    {
        //TODO faire les trads pour le changement générique polonais / arabes / anglais
        if ($langue === "fr")      $result = "Changement effectué";
        else if ($langue === "ar") $result = "تم التغيير ";
        else if ($langue === "pl") $result = "";
        else                       $result = "Modification done";
        return $result ;
    }

    public static function sucessChangementMdp(string $langue)
    {
        //TODO faire les trads pour le changement de mot de passe polonais / arabes / anglais
        if ($langue === "fr")      $result = "Changement de mot de passe effectué";
        else if ($langue === "ar") $result = "تم تغيير كلمة المرور ";
        else if ($langue === "pl") $result = "";
        else                       $result = "Password modification done";
        return $result ;
    }

    public static function isValide($langue)
    {
        //TODO traducction des validations user
        if ($langue === "fr")       $result = "utilisateur validé";
        else if ($langue === "ar")  $result = "تم التحقق من المستخدم ";
        else if ($langue === "pl")  $result = "";
        else                        $result = "User is valid";
        return $result;

    }

    public static function isBanned($langue)
    {
        //TODO traducction des ban user
        if ($langue === "fr")       $result = "utilisateur banni";
        else if ($langue === "ar")  $result = "تم حذف المستخدم";
        else if ($langue === "pl")  $result = "";
        else                        $result = "User banned";
        return $result;
    }

    public static function DateDebutSupDatefin(string $langue)
    {
        //TODO traducction des DateDebutSupDatefin
        if ($langue === "fr")       $result = "La date de recherche du début est supérieur a la date de fin";
        else if ($langue === "ar")  $result = "تاريخ البدأ أكبر من تاريخ النهاية";
        else if ($langue === "pl")  $result = "";
        else                        $result = "Searching date of the beginning is over end date ";
        return $result;
    }

    public static function sucessAddNewSchool($langue)
    {
        //TODO traducction des sucessAddNewSchool
        if ($langue === "fr")       $result = "L'école a bien été ajouté";
        else if ($langue === "ar")  $result = "";
        else if ($langue === "pl")  $result = "";
        else                        $result = "";
        return $result;
    }

    public static function errorBasique($langue)
    {
        //TODO traducction des errorAddNewSchool
        if ($langue === "fr")       $result = "Une error est survenue ";
        else if ($langue === "ar")  $result = "";
        else if ($langue === "pl")  $result = "";
        else                        $result = "";
        return $result;
    }
}