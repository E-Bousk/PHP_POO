<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        // Paramètre le dossier contenant les templates
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        // Paramètre l'envrionnement TWIG
        $this->twig = new Environment($this->loader);
    }
    
    public function render(string $file, array $data = [], string $template = 'default')
    {
        // On extrait le contenu de '$data'
        extract($data);
        
        // On démarre le buffer de sortie
        ob_start();
        // A partir de ce point, toute sortie est conservée en mémoire
        
        //On crée le chemin vers la vue
        require_once ROOT . '/Views/'. $file .'.php';
        
        // On transfert le contenu du buffer dans une variable
        $contenu = ob_get_clean();
        
        // On utilise le template de page qui utilise '$contenu'
        require_once ROOT . '/Views/' . $template . '.php';
    }
}