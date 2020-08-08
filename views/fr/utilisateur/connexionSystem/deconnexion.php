<?php

$deconnexion = new \Psiko\UserSystem();
$deconnexion->deconnexion();
header("Location: /fr/connexion");
exit();