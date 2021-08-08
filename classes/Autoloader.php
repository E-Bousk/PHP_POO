<?php

namespace App;

class Autoloader
{
    // 'static' === méthode accessible sans avoir à instancier la classe
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans '$class' la totalité du namespace de la classe concernée (ex: « App\Client\Compte »)
        // echo "{$class} <br>" ;
        
        // On retire « App\ » (avec l'aide de « __NAMESPACE__ ») pour avoir « Client\Compte »
        $class= str_replace(__NAMESPACE__ . '\\', '', $class);
        // echo "{$class} <br>" ;

        // On remplace les « \ » par des « / »  pour avoir « Client/Compte »
        $class= str_replace('\\', '/', $class);
        // echo "{$class} <br>" ;

        // On concatène le tout avec le path (avec « __DIR__ ») et l'extension « .php » pour charger le fichier
        $fichier= __DIR__ . '/' . $class . '.php';

        // On verifie si e fichier existe
        if (file_exists($fichier)) {
            require_once $fichier;
        }

    }   
}