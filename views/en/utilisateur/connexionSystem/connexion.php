<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->authentification($_POST["email"],$_POST["password"],"fr");
    if (empty($_SESSION["notification"]["error"]))
    {
        header("Location: /en/utilisateur/profil/");
    }
}
$form = new \Psiko\helper\form();

?>
<form class="form-inscription" method="post" action="">
    <?= $form->input("email","Email :","email",true,"email@isep.fr")?>
    <?= $form->input("password","Password:","password",true,"azertyuio")?>
    <a href="oublieMDP.html" class="center">Forgotten password?</a>
    <button type="submit" class="btn-submit">Log in</button>

</form>
