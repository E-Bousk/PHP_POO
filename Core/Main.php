<?php

namespace App\Core;

use App\Controllers\MainController;

/**
 * Router principal
 */
class Main
{
    public function start()
    {
        // *** On retire le "trailing slash" éventuel de l'URL (le slash à la fin de l'URL) ***

        // On récupère l'URL
        $uri = $_SERVER["REQUEST_URI"];

        //On vérifie que URI n'est pas vide et se termine par un slash
        // if ($uri !== null && substr($uri, -1) === "/") {
        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            // On enlève le dernier slash (pour éviter le 'duplicate content' car les 2 URLs sont valides)
            // $uri = rtrim($uri, "/");
            $uri = substr($uri, 0, -1);

            // On envoie un code de redirection permanente
            http_response_code(301);

            // On redirige vers l'URL sans slash
            header('Location: '.$uri);
        }

        // *** On gère les paramètres (index.php?p=controlleur/méthode/paramètres) ***

        // On sépare les paramètres dans un tableau
        $params = explode('/', $_GET['p']);

        // On vérifie que l'on ait au moins 1 paramètre
        if ($params[0] != '') {
            // Au moins 1 paramètre :
            // On récupère le nom du contrôleur à instancié
            // On met une majuscule à sa 1ere lettre, on ajoute son namespace devant et "Controller" après
            // NOTE : 'array_shift' retourne et SUPPRIME le 1er élément du tableau
            $controller = 'App\\Controllers\\'. ucfirst(array_shift($params)) . 'Controller';
            
            // On instancie le contrôleur
            $controller = new $controller;

            // Si encore qqchose dans tableau (donc 2éme paramètre de l'URL), on appelle cette méthode,
            // sinon on appelle la méthode INDEX
            // NOTE : 'array_shift' retourne et SUPPRIME le 1er élément du tableau

            $method = (isset($params[0]) ? array_shift($params) : 'index');

            // on vérifie que la méthode existe dans cette classe, sinon 404
            if (method_exists($controller, $method)) {
                // On vérifie s'il reste des paramètres pour les passer à la méthode
                (isset($params[0])) ? call_user_func_array([$controller, $method], $params) : $controller->$method();
            } else {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {
            // Pas de paramètre : on instancie le contrôleur par défaut
            $controller = new MainController;

            // On appelle la méthode INDEX
            $controller->index();
        }
    }
}