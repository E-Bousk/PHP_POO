<?php

namespace App\Banque;

use App\Client\Compte as CompteClient;

/**
 * Compte avec taux d'intérêt 
 */
class CompteEpargne extends Compte
{
    /**
     * Taux d'intérêt du compte
     * @var float
     */
    private $taux_interet;

    /**
     * Constructeur de compte épargne
     *
     * @param CompteClient $compte compte client du titulaire
     * @param float $montant Montant du solde à l'ouverture
     * @param float $taux Taux d'intérêt
     * @return void
     */
    public function __construct(CompteClient $compte, float $montant, float $taux = 2.2)
    {
        // On transfère les informations nécessaires au constructeur de 'Compte' (classe mère)
        parent::__construct($compte, $montant);
        $this->taux_interet = $taux;
    }

    /**
     * Get taux d'intérêt du compte
     *
     * @return float
     */ 
    public function getTauxInteret(): float
    {
        return $this->taux_interet;
    }

    /**
     * Set taux d'intérêt du compte
     *
     * @param float $taux_interet  Taux d'intérêt du compte
     *
     * @return self
     */ 
    public function setTauxInteret(int $taux): self
    {
        if ($taux >=0) {
            $this->taux_interet = $taux;
        }

        return $this;
    }

    /**
     * Calculer et ajouter les intérêts au solde
     *
     * @return void
     */
    public function verserInterets()
    {
        $this->solde= $this->solde + ($this->solde * $this->taux_interet /100);
    }
}