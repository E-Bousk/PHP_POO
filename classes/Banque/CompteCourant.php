<?php

namespace App\Banque;

use App\Client\Compte as CompteClient;

/**
 * Compte bancaire (hérite de Compte)
 */
class CompteCourant extends Compte
{
    private $decouvert;

    /**
     * Constructeur de compte courant
     *
     * @param CompteClient $compte compte client du titulaire
     * @param float $montant Montant du solde à l'ouverture
     * @param integer $decouvert Découvert autorisé
     * @return void
     */
    public function __construct(CompteClient $compte, float $montant, int $decouvert = 200)
    {
        // On transfère les informations nécessaires au constructeur de 'Compte'
        parent::__construct($compte, $montant);

        $this->decouvert = $decouvert;
    }

    /**
     * Undocumented function
     *
     * @param Type $var
     * @return int
     */
    public function getDecouvert():int
    {
        return $this->decouvert;
    }

    /**
     * Undocumented function
     *
     * @param Type $var
     * @return int
     */
    public function setDecouvert(int $montant): self
    {
        if ($montant >= 0) {
            $this->decouvert= $montant;
        }
        return $this;
    }

    // On réécrit la méthode 'retirer'
    /**
     * Retire un montant du solde du compte et verifie si on ne dépasse pas le découvert autorisé
     *
     * @param float $montant Montant à retirer
     * @return void
     */
    public function retirer(float $montant)
    {
        // On verifie si le découvert permet le retrait
        // On accède à '($this->)solde' car elle est 'protected'. Si elle était réstée à 'private', on n'y accèderait pas
        if ($montant > 0 && $this->solde - $montant >= -$this->decouvert) {
            $this->solde -= $montant;
        } else { 
            echo 'Solde insuffisant';
        }
    }
}