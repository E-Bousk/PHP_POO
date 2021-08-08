<?php
require_once 'classes/Compte.php';

// On instancie le compte
$compte1= new Compte('Casimir', 500);

// $compte1->setSolde(200);

// On écrit dans la propriété titulaire
// $compte1->titulaire= "Casimir";

// On écrit dans la propriété solde
// $compte1->solde= 500;

// On dépose 100 euro
$compte1->deposer(100);

echo $compte1->getTitulaire();

$compte1->setTitulaire("");

?>
<p><?= $compte1->voirSolde(); ?></p>
<?php

$compte1->retirer(500);

var_dump($compte1);

echo "Le taux d'intéret du compte est : ". Compte::TAUX_INTERETS."% <br>";

echo $compte1; // on affiche sans erreur grâce à la méthode '__toString'

// $compte2= new Compte('Polux');

// // $compte2->titulaire= "Polux";

// // $compte2->solde= 389.25;

// var_dump($compte2);