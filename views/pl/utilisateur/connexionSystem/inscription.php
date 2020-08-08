<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->inscription($_POST,"pl");
}
$form = new \Psiko\helper\form();
?>



<form class="form-inscription" method="POST" action="">
    <?= $form->input("nom","Nazwisko :","text",true,"CZERNIAWSKI")?>
    <?= $form->input("prenom","Imię :","text",true,"Michał")?>
    <?= $form->input("email","E-mail :","email",true,"Michał.CZERNIAWSKI@op.pl")?>
    <?= $form->input("password","Hasło:","password",true,"napiszhasło")?>
    <?= $form->input("passwordRpt","Powtórz hasło:","password",true,"napisz hasło")?>
    <?= $form->input("adresse","Twój adres","text",true,"ulica czarnego lasu")?>
    <?= $form->input("codePostal","Kod pocztowy","text",true,"przykład : 05500")?>

    <?= $form->input("numeroTelephone","Numer telefonu","text",true,"+48215483214")?>
    <?= $form->inputDate("birthday", "Data urodzenia", "1900-1-1", "2100-1-1",)?>
    <?= $form->inputSelect("sexe", "płeć", array("H" => "Mężczyzna", "F" => "Kobieta", "NR" => "Nie podano"), "NR", true)?>
    <button type="submit" class="btn-submit">Zarejestruj się</button>
</form>
