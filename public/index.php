<?php

require ("../src/routeur/AltoRouter.php");
require ("../src/routeur/Routeur.php");
require ("../src/database/MysqlDatabase.php");
require ("../src/helper/Helper.php");
require ("../src/helper/Form.php");
require("../src/Entity/UserEntity.php");
require("../src/database/UserTable.php");
require ("../src/helper/Notification.php");
require ("../src/TicketSystem.php");
require ("../src/Entity/TicketsEntity.php");
require ("../src/database/TicketsTable.php");
require ("../src/UserSystem.php");
require ("../src/FaqSystem.php");
require ("../src/database/FAQTable.php");
require ("../src/Entity/FaqEntity.php");
require ("../src/Entity/TestEntity.php");
require ("../src/TestSystem.php");
require ("../src/database/testTable.php");
require ("../src/database/EcoleDatabase.php");
require ("../src/Entity/EcoleEntity.php");
require ("../src/EcolesSystemes.php");

ob_start();
$routeur = new \Psiko\routeur\Routeur(dirname(__DIR__) . '/views', dirname(__DIR__) ."/public");
session_start();
$routeur->getAllPageFrançais()
        ->getAllPageAnglais()
        ->getAllPageArabe()
        ->getAllPagePolonais()
        ->run();
$autrePages = $routeur->getPageOtherLanguage();

$contenue = ob_get_clean();
require dirname(__DIR__) .DIRECTORY_SEPARATOR. 'views/templates/default.php';

