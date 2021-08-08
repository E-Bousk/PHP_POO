<?php

namespace App\Banque;

class CompteEpargneCourant extends CompteEpargne
{
    private $decouvert;

    /**
     * Constructeur de compte épargne courant
     *
     * @param string $nom Nom du titulaire
     * @param float $montant Montant du solde à l'ouverture
     * @param integer $decouvert Découvert autorisé
     * @param float $taux Taux d'intérêt
     * @return void
     */
    public function __construct(string $nom, float $montant, float $taux = 2.2, int $decouvert = 200)
    {
        // On transfère les informations nécessaires au constructeur de 'Compte'
        parent::__construct($nom, $montant, $taux);

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