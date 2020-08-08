<?php

$deconnexion = new \Psiko\UserSystem();
$deconnexion->deconnexion();
header("Location: /ar/تسجيل الدخول/");
exit();