<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /en/connexion/");
    exit();
}
$userSystem = new \Psiko\UserSystem();

if (isset($_FILES["profilPicture"]))
{
    $_SESSION["notification"] = $userSystem->changeProfilPicture($_FILES["profilPicture"],$_SESSION["auth"]->getId(),"en");
}
$salutation = [];
$form = new \Psiko\helper\form();
$user = $userSystem->getUserById($_SESSION["auth"]->getId());

if (!empty($_POST))
{
    if (!empty($_POST["email"])) $_SESSION["notification"] = $userSystem->changeEmail($_POST["email"],$user->getId(),"en");
    if (!empty($_POST["sexe"])) $_SESSION["notification"] = $userSystem->changeSexe($_POST["sexe"],$user->getId(),"en");
    if (!empty($_POST["adresse"])) $_SESSION["notification"] = $userSystem->changeAdresse($_POST["adresse"],$user->getId(),"en");
    if (!empty($_POST["oldPassword"]))$_SESSION["notification"] = $userSystem->changeMdp($_POST,$user->getId(),"fr");
    if (!empty($_POST["numeroTelephone"]))$_SESSION["notification"] = $userSystem->changeTelephone($_POST["numeroTelephone"], $user->getId(), "en");
    $user = $userSystem->getUserById($_SESSION["auth"]->getId());

}

?>
    <div class="modif-profil">

            <div class="bienvenueprofil">
                <h1> Welcome  </h1>
                <img src="/avatar/<?=$user->getPhotoPicture()?>"  width="300px" height="300px" style="border-radius: 150px; padding: 25px; ">
            </div>
            <form method="post" action="" enctype="multipart/form-data" class="changement-image-modif-profil" >
                <?=$form->inputFile("profilPicture","Profile picture :",".png,.jpg")?>
                <input type="submit" class="btn btn-neutral" value="Change profile picture">
            </form>
           <form>

           </form>
        <form method="post" action="">
            <?= $form->input("email","Email :","email",true,"John.Doe@isep.fr")?>
            <input type="submit" class="btn btn-neutral" value="Modify email">
        </form  method="post" action="">
        <form  method="post" action="">
            <?= $form->inputSelect("sexe", "Sex", array("H" => "Homme", "F" => "Femme", "NR" => "non renseigné"),$user->getSexe()."" , true)?>
            <input type="submit" class="btn btn-neutral" value="Modify gender">
        </form>
        <form  method="post" action="">
            <?= $form->input("adresse","Your address","text",true,"example : 21 bis bakerstreet")?>
            <input type="submit" class="btn btn-neutral" value="Modify adress">
        </form>
        <form  method="post" action="">
            <?= $form->input("numeroTelephone","Your phone number","text",true,"0601020304")?>
            <input type="submit" class="btn btn-neutral" value="Modify phone number">
        </form>
        <form  method="post" action="">
            <?= $form->input("oldPassword","old Password :","password",true,"JaimeLesMangarine")?>
            <?= $form->input("newPassword","new Password :","password",true,"JaimeLesMangarine2")?>
            <?= $form->input("newPasswordRpt","repeat New password :","password",true,"JaimeLesMangarine2")?>
            <input type="submit" class="btn btn-neutral" value="Modify password">
        </form>
    </div>

