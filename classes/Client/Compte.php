<?php

namespace App\Client;

/**
 * Objet compte bancaire
 */
class Compte
{
    private $nom;
    private $prenom;
    private $ville;

    public function __construct(string $nom, string $prenom, string $ville) {
        $this->nom = $nom;
        $this->prenom= $prenom;
        $this->ville= $ville;
    }
}