<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->inscription($_POST,"fr");
}
$form = new \Psiko\helper\form();
?>



<form class="form-inscription" method="POST" action="">
    <?= $form->input("nom","Last Name :","text",true,"TYPE HERE")?>
    <?= $form->input("prenom","First Name :","text",true,"TYPE HERE")?>
    <?= $form->input("email","Email :","email",true,"TYPE HERE")?>
    <?= $form->input("password","Password :","password",true,"TYPE HERE")?>
    <?= $form->input("passwordRpt","Repeat password :","password",true,"TYPE HERE")?>
    <?= $form->input("adresse","Your adress","text",true,"TYPE HERE")?>
    <?= $form->input("codePostal","Postal code","text",true,"TYPE HERE")?>

    <?= $form->input("numeroTelephone","Phone number","text",true,"TYPE HERE")?>
    <?= $form->inputDate("birthday", "Birth date", "1900-1-1", "2100-1-1",)?>
    <?= $form->inputSelect("sexe", "Sex", array("H" => "Male", "F" => "Female", "NR" => "Unknown"), "NR", true)?>
    <button type="submit" class="btn-submit">Sign Up</button>
</form>
