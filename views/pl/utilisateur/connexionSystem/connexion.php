<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->authentification($_POST["email"],$_POST["password"],"pl");
    if (empty($_SESSION["notification"]["error"]))
    {
        header("Location: /pl/utilisateur/profil/");
    }
}
$form = new \Psiko\helper\form();

?>
<form class="form-inscription" method="post" action="">
    <?= $form->input("email","E-mail :","email",true,"Michał.CZERNIAWSKI@op.pl")?>
    <?= $form->input("password","Hasło:","password",true,"Wpisz hasło")?>
    <a href="oublieMDP.html" class="center">Zapomniałem hasła</a>
    <button type="submit" class="btn-submit">Zaloguj się</button>

</form>
