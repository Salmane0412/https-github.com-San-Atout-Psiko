<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->inscription($_POST,"ar");
}
$form = new \Psiko\helper\form();
?>



<form class="form-inscription" method="POST" action="">
    <?= $form->input("nom","Nom de Famille :","text",true,"DOE")?>
    <?= $form->input("prenom","Prénom :","text",true,"John")?>
    <?= $form->input("email","Email :","email",true,"John.Doe@isep.fr")?>
    <?= $form->input("password","Mot de Passe :","password",true,"JaimeLesMangarine")?>
    <?= $form->input("passwordRpt","Répetez le mot de passe :","password",true,"JaimeLesMangarine")?>
    <?= $form->input("adresse","Votre adresse","text",true,"JaimeLesMangarine")?>
    <?= $form->input("codePostal","code Postal","text",true,"exemple : 75015")?>

    <?= $form->input("numeroTelephone","Votre Numero de téléphone","text",true,"0601020304")?>
    <?= $form->inputDate("birthday", "Date de naissance", "1900-1-1", "2100-1-1",)?>
    <?= $form->inputSelect("sexe", "Sexe", array("H" => "Homme", "F" => "Femme", "NR" => "non renseigné"), "NR", true)?>  <!-- à traduire -->
    <button type="submit" class="btn-submit">التسجيل </button>
</form>
