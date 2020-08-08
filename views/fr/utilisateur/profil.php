<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /fr/connexion/");
    exit();
}
$userSystem = new \Psiko\UserSystem();

if (isset($_FILES["profilPicture"]))
{
    $_SESSION["notification"] = $userSystem->changeProfilPicture($_FILES["profilPicture"],$_SESSION["auth"]->getId(),"fr");
}
$salutation = [];
$form = new \Psiko\helper\form();
$user = $userSystem->getUserById($_SESSION["auth"]->getId());

if (!empty($_POST))
{
    if (!empty($_POST["email"])) $_SESSION["notification"] = $userSystem->changeEmail($_POST["email"],$user->getId(),"fr");
    if (!empty($_POST["sexe"])) $_SESSION["notification"] = $userSystem->changeSexe($_POST["sexe"],$user->getId(),"fr");
    if (!empty($_POST["adresse"])) $_SESSION["notification"] = $userSystem->changeAdresse($_POST["adresse"],$user->getId(),"fr");
    if (!empty($_POST["oldPassword"]))$_SESSION["notification"] = $userSystem->changeMdp($_POST,$user->getId(),"fr");
    if (!empty($_POST["numeroTelephone"]))$_SESSION["notification"] = $userSystem->changeTelephone($_POST["numeroTelephone"], $user->getId(), "fr");
    $user = $userSystem->getUserById($_SESSION["auth"]->getId());

}

?>
    <div class="modif-profil">

            <div class="bienvenueprofil">
                <h1> Bienvenue  </h1>
                <img src="/avatar/<?=$user->getPhotoPicture()?>"  width="300px" height="300px" style="border-radius: 150px; padding: 25px; ">
            </div>
            <form method="post" action="" enctype="multipart/form-data" class="changement-image-modif-profil" >
                <?=$form->inputFile("profilPicture","Photo de profil :",".png,.jpg")?>
                <input type="submit" class="btn btn-neutral" value="Changer Votre photo de profil">
            </form>
           <form>

           </form>
        <form method="post" action="">
            <?= $form->input("email","Email :","email",true,"John.Doe@isep.fr")?>
            <input type="submit" class="btn btn-neutral" value="Modifier votre email">
        </form  method="post" action="">
        <form  method="post" action="">
            <?= $form->inputSelect("sexe", "Sexe", array("H" => "Homme", "F" => "Femme", "NR" => "non renseigné"),$user->getSexe()."" , true)?>
            <input type="submit" class="btn btn-neutral" value="Modifier votre sexe">
        </form>
        <form  method="post" action="">
            <?= $form->input("adresse","Votre adresse","text",true,"exemple : 21 bis bakerstreet")?>
            <input type="submit" class="btn btn-neutral" value="Modifier votre adresse">
        </form>
        <form  method="post" action="">
            <?= $form->input("numeroTelephone","Votre Numero de téléphone","text",true,"0601020304")?>
            <input type="submit" class="btn btn-neutral" value="Modifier votre adresse">
        </form>
        <form  method="post" action="">
            <?= $form->input("oldPassword","Ancien mot de Passe :","password",true,"JaimeLesMangarine")?>
            <?= $form->input("newPassword","Nouveaux mot de Passe :","password",true,"JaimeLesMangarine2")?>
            <?= $form->input("newPasswordRpt","Répetez le nouveau mot de passe :","password",true,"JaimeLesMangarine2")?>
            <input type="submit" class="btn btn-neutral" value="Modifier votre mots de passe">
        </form>
    </div>

