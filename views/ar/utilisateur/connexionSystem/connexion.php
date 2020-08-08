<?php
if (!empty($_POST))
{
    $user = new \Psiko\UserSystem();
    $_SESSION["notification"] = $user->authentification($_POST["email"],$_POST["password"],"ar");
    if (empty($_SESSION["notification"]["error"]))
    {
        header("Location: /ar/mostakhdim/milafchakhi/");
    }
}
$form = new \Psiko\helper\form();

?>
<form class="form-inscription" method="post" action="">
    <?= $form->input("email","Email :","email",true,"John.Doe@isep.fr")?>
    <?= $form->input("password","Mot de Passe :","password",true,"JaimeLesMangarine")?>
    <a href="oublieMDP.html" class="center">نسيت كلمة المرو</a>
    <button type="submit" class="btn-submit">تسجيل الدخول</button>

</form>
