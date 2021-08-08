<?php
require_once 'classes/Compte.php';
require_once 'classes/CompteCourant.php';
require_once 'classes/CompteEpargne.php';
require_once 'classes/CompteEpargneCourant.php';

// On instancie le compte
$compteCourant= new CompteCourant('Casimir', 500); // 3eme argument optionnel (montant découvert = 200 par défaut )
$compteCourant= new CompteCourant('Casimir', 500, 300);
// $compteCourant->setDecouvert(800);
// $compteCourant->retirer(800);
$compteCourant->setTitulaire('Polux');
$compteCourant->retirer(700);
var_dump($compteCourant);

echo('<hr>');

$compteEpargne= new CompteEpargne('Casimir', 500); // 3eme argument optionnel (taux d'intérêt = 2.2 par défaut)
$compteEpargne= new CompteEpargne('Casimir', 500, 3.2);
var_dump($compteEpargne);
echo('-------------------- <br>');
$compteEpargne->verserInterets();
$compteEpargne->retirer(600);
var_dump($compteEpargne);


echo('<hr>');

$compteEpargneCourant= new CompteEpargneCourant('Casimir', 500); // 3eme et 4eme argument optionnels (taux d'intérêt = 2.2 par défaut)
$compteEpargneCourant= new CompteEpargneCourant('Casimir', 500, 3.2, 400);
var_dump($compteEpargneCourant);
echo('-------------------- <br>');
$compteEpargneCourant->verserInterets();
$compteEpargneCourant->retirer(600);
var_dump($compteEpargneCourant);

echo('<hr>');
