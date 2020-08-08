<?php

$deconnexion = new \Psiko\UserSystem();
$deconnexion->deconnexion();
header("Location: /en/connexion");
exit();