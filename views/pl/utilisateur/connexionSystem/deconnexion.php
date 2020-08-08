<?php

$deconnexion = new \Psiko\UserSystem();
$deconnexion->deconnexion();
header("Location: /pl/connexion");
exit();