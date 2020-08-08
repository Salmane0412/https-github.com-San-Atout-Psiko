<?php
if (!isset($_SESSION["auth"]))
{
    header("Location: /pl/connexion/");
    exit();
}
$userSystem = new \Psiko\UserSystem();

if (isset($_FILES["profilPicture"]))
{
    $_SESSION["notification"] = $userSystem->changeProfilPicture($_FILES["profilPicture"],$_SESSION["auth"]->getId(),"pl");
}
$salutation = [];
$form = new \Psiko\helper\form();
$user = $userSystem->getUserById($_SESSION["auth"]->getId());

if (!empty($_POST))
{
    if (!empty($_POST["email"])) $_SESSION["notification"] = $userSystem->changeEmail($_POST["email"],$user->getId(),"pl");
    if (!empty($_POST["sexe"])) $_SESSION["notification"] = $userSystem->changeSexe($_POST["sexe"],$user->getId(),"pl");
    if (!empty($_POST["adresse"])) $_SESSION["notification"] = $userSystem->changeAdresse($_POST["adresse"],$user->getId(),"pl");
    if (!empty($_POST["oldPassword"]))$_SESSION["notification"] = $userSystem->changeMdp($_POST,$user->getId(),"pl");
    if (!empty($_POST["numeroTelephone"]))$_SESSION["notification"] = $userSystem->changeTelephone($_POST["numeroTelephone"], $user->getId(), "pl");
    $user = $userSystem->getUserById($_SESSION["auth"]->getId());

}

?>
    <div class="modif-profil">

            <div class="bienvenueprofil">
                <h1> Witam  </h1>
                <img src="/avatar/<?=$user->getPhotoPicture()?>"  width="300px" height="300px" style="border-radius: 150px; padding: 25px; ">
            </div>
            <form method="post" action="" enctype="multipart/form-data" class="changement-image-modif-profil" >
                <?=$form->inputFile("profilPicture","Photo de profil :",".png,.jpg")?>
                <input type="submit" class="btn btn-neutral" value="Zmień swoje zdjęcie profilowe">
            </form>
           <form>

           </form>
        <form method="post" action="">
            <?= $form->input("email","E-mail :","email",true,"Michał.CZERNIAWSKI@op.pl")?>
            <input type="submit" class="btn btn-neutral" value="Edytuj swój e-mail">
        </form  method="post" action="">
        <form  method="post" action="">
            <?= $form->inputSelect("sexe", "płeć", array("H" => "Mężczyzna", "F" => "Kobieta", "NR" => "Nie podano"),$user->getSexe()."" , true)?>
            <input type="submit" class="btn btn-neutral" value="Zmień płeć">
        </form>
        <form  method="post" action="">
            <?= $form->input("adresse","Twój adres","text",true," przykład : ulica czarnego lasu")?>
            <input type="submit" class="btn btn-neutral" value="Zmień adres">
        </form>
        <form  method="post" action="">
            <?= $form->input("numeroTelephone","Numer telefonu","text",true,"+48215483214")?>
            <input type="submit" class="btn btn-neutral" value="Zmień swój numer telefonu">
        </form>
        <form  method="post" action="">
            <?= $form->input("oldPassword","Stare hasło :","password",true,"wpisz swoje stare hasło")?>
            <?= $form->input("newPassword","Nowe hasło:","password",true,"wpisz swoje nowe hasło")?>
            <?= $form->input("newPasswordRpt","Powtórz nowe hasło :","password",true,"wpisz swoje nowe hasło")?>
            <input type="submit" class="btn btn-neutral" value="Zmień swoje hasło">
        </form>
    </div>

