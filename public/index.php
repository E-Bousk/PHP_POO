<?php

use App\Autoloader;
use App\Core\Main;

// On définit une constante (ROOT) contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// On importe l'autoloader
require_once ROOT.'/vendor/Autoload.php';
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// On instancie MAIN (notre routeur)
$app = new Main;

// On démarre l'application
$app->start();