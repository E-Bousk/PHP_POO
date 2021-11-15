<?php

use App\Autoloader;
use App\Client\Compte as CompteClient;
use App\banque\{CompteCourant, CompteEpargne, CompteEpargneCourant};

require_once '../vendor/Autoload.php';
require_once 'classes/Autoloader.php';
Autoloader::register();

// // $client= new \App\Client\Compte;
$client= new CompteClient('Casimir', 'Polux', 'Toulouse');
dump($client);

echo '<hr>';

// On instancie le compte
// $compteCourant= new CompteCourant('Casimir', 500); // 3eme argument optionnel (montant découvert = 200 par défaut )
$compteCourant= new CompteCourant($client, 500, 300);
// // $compteCourant->setDecouvert(800);
// // $compteCourant->retirer(800);
// $compteCourant->setTitulaire('Polux');
// $compteCourant->retirer(700);
dump($compteCourant);

echo '<hr>';

// $compteEpargne= new CompteEpargne('Casimir', 500); // 3eme argument optionnel (taux d'intérêt = 2.2 par défaut)
$compteEpargne= new CompteEpargne($client, 500, 3.2);
// dump($compteEpargne);
// echo '-------------------- <br>';
// $compteEpargne->verserInterets();
// $compteEpargne->retirer(600);
dump($compteEpargne);


echo '<hr>';

// $compteEpargneCourant= new CompteEpargneCourant('Casimir', 500); // 3eme et 4eme argument optionnels (taux d'intérêt = 2.2 par défaut)
$compteEpargneCourant= new CompteEpargneCourant($client, 500, 3.2, 400);
// dump($compteEpargneCourant);
// echo '-------------------- <br>';
// $compteEpargneCourant->verserInterets();
// $compteEpargneCourant->retirer(600);
dump($compteEpargneCourant);

echo '<hr>';

