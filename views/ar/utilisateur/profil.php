<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /ar/mostakhdim/milafchakhi/");
    exit();
}
$userSystem = new \Psiko\UserSystem();

if (isset($_FILES["profilPicture"]))
{
    $_SESSION["notification"] = $userSystem->changeProfilPicture($_FILES["profilPicture"],$_SESSION["auth"]->getId(),"ar");
}
$salutation = [];
$form = new \Psiko\helper\form();
$user = $userSystem->getUserById($_SESSION["auth"]->getId());

if (!empty($_POST))
{
    if (!empty($_POST["email"])) $_SESSION["notification"] = $userSystem->changeEmail($_POST["email"],$user->getId(),"ar");
    if (!empty($_POST["sexe"])) $_SESSION["notification"] = $userSystem->changeSexe($_POST["sexe"],$user->getId(),"ar");
    if (!empty($_POST["adresse"])) $_SESSION["notification"] = $userSystem->changeAdresse($_POST["adresse"],$user->getId(),"ar");
    if (!empty($_POST["oldPassword"]))$_SESSION["notification"] = $userSystem->changeMdp($_POST,$user->getId(),"ar");
    if (!empty($_POST["numeroTelephone"]))$_SESSION["notification"] = $userSystem->changeTelephone($_POST["numeroTelephone"], $user->getId(), "ar");
    $user = $userSystem->getUserById($_SESSION["auth"]->getId());

}

?>
    <div class="modif-profil">

            <div class="bienvenueprofil">
                <h1> مـــرحبا </h1>
                <img src="/avatar/<?=$user->getPhotoPicture()?>"  width="300px" height="300px" style="border-radius: 150px; padding: 25px; ">
            </div>
            <form method="post" action="" enctype="multipart/form-data" class="changement-image-modif-profil" >
                <?=$form->inputFile("profilPicture","Photo de profil :",".png,.jpg")?>
                <input type="submit" class="btn btn-neutral" value="غيير صورة ملفك الشخصي">
            </form>
           <form>

           </form>
        <form method="post" action="">
            <?= $form->input("email","Email :","email",true,"John.Doe@isep.fr")?>
            <input type="submit" class="btn btn-neutral" value="غيير بريدك الإلكتروني">
        </form  method="post" action="">
        <form  method="post" action="">
            <?= $form->inputSelect("sexe", "Sexe", array("H" => "Homme", "F" => "Femme", "NR" => "non renseigné"),$user->getSexe()."" , true)?>
            <input type="submit" class="btn btn-neutral" value="قم بتعديل العنوان">
        </form>
        <form  method="post" action="">
            <?= $form->input("adresse","Votre adresse","text",true,"exemple : 21 bis bakerstreet")?>
            <input type="submit" class="btn btn-neutral" value="قم بتعديل العنوان">
        </form>
        <form  method="post" action="">
            <?= $form->input("numeroTelephone","Votre Numero de téléphone","text",true,"0601020304")?>
            <input type="submit" class="btn btn-neutral" value="غيير رقم الهاتف">
        </form>
        <form  method="post" action="">
            <?= $form->input("oldPassword","Ancien mot de Passe :","password",true,"JaimeLesMangarine")?>
            <?= $form->input("newPassword","Nouveaux mot de Passe :","password",true,"JaimeLesMangarine2")?>
            <?= $form->input("newPasswordRpt","Répetez le nouveau mot de passe :","password",true,"JaimeLesMangarine2")?>
            <input type="submit" class="btn btn-neutral" value="غيير كلمة مرورك">
        </form>
    </div>

