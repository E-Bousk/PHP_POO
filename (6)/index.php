<?php

use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;

require_once '../vendor/Autoload.php';
require_once 'Autoloader.php';
Autoloader::register();

// $model = new AnnoncesModel;
/////////////////////////////////////////////////////////////////
// $annonces= $model->findall();
// dump($annonces);
/////////////////////////////////////////////////////////////////
// $annonces= $model->findBy(['actif' => 1]);
// dump($annonces);
/////////////////////////////////////////////////////////////////
// $annonces= $model->find(2);
// dump($annonces);
/////////////////////////////////////////////////////////////////
// $annonce = $model->setTitre('Nouvelle annonce 2')
//                 ->setDescription('Nouvelle description 2')
//                 ->setActif(0)
// ;
// $model->create($annonce);
// var_dump($annonce);
/////////////////////////////////////////////////////////////////
// Tableau récupéré avec un POST par exemple
// $donnees = [
//     'titre' => 'Ajout par hydratation',
//     'description' => 'On insert par une méthode d\'hydratation',
//     'actif' => 1,
// ];
// dump($donnees);
// $annonce = $model->hydrate($donnees);
// $model->create($annonce);
// var_dump($annonce);
/////////////////////////////////////////////////////////////////
// Tableau récupéré avec un formulaire par exemple
// $donnees = [
//     'titre' => 'Annonce modifiée',
//     'description' => 'On modifie encore par la méthode UPDATE',
//     'actif' => 0
// ];
// $annonce = $model->hydrate($donnees);
// $model->update(11, $annonce);
// var_dump($annonce);
/////////////////////////////////////////////////////////////////
// $model->delete(13);
/////////////////////////////////////////////////////////////////

$model = new UsersModel;
// var_dump($model);

// $user = $model->setEmail('email@email.com')
// ->setPassword(password_hash('root', PASSWORD_ARGON2I))
// ;
// $model->create($user);

// $model->delete(3);

$users= $model->findall();
dump($users);
