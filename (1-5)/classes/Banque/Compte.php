<?php

namespace App\Banque;

use App\Client\Compte as CompteClient;

/**
 * Objet compte bancaire
 */
abstract class Compte
{
    // Propriétés
    /**
     * Titulaire du compte
     *
     * @var CompteClient
     */
    private CompteClient $titulaire;

    /**
     * Solde du compte
     *
     * @var float
     */
    // 'protected' === 'private' avec la prise en compte de l'héritage
    protected float $solde;

    // Méthodes
    /**
     * Constructeur du compte bancaire
     *
     * @param CompteClient $compte Compte client titulaire
     * @param float $montant Montant du solde du titulaire
     */
    public function __construct(CompteClient $compte, float $montant = 100)
    {
        // On attribue le nom à la propriété titulaire de l'instance créée
        $this->titulaire = $compte;
        
        // On attribue le montant à la propriété solde
        $this->solde= $montant;
    }

    /**
     * Méthode magique pour la conversion en chaîne de caractères
     *
     * @return string
     */
    public function __toString()
    {
        return "Vous visualisez le compte de {$this->titulaire}, le solde est de {$this->solde} €";
    }

    // Accesseurs
    
    /**
     * Getter de titulaire - Retourne la valeur du titulaire du compte
     *
     * @return CompteClient
     */
    public function getTitulaire(): CompteClient
    {
        return $this->titulaire;
    }

    /**
     * Modifie le compte du titulaire et retourne l'objet
     *
     * @param CompteClient $compte Compte client du titulaire
     * @return Compte Compte bancaire
     */
    public function setTitulaire(CompteClient $compte): self
    {
        // On verifie si on a un titulaire
        if (isset($compte)) {
            $this->titulaire= $compte;
        }
        return $this;
    }

    /**
     * Retourne le solde du compte
     *
     * @return float Solde du compte
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * Modifie le solde du compte
     *
     * @param float $montant Montant à ajouter
     * @return Compte Compte bancaire
     */
    public function setSolde(float $montant): self
    {
        if ($montant >= 0) {
            $this->solde= $montant;
        }
        return $this;
    }

    /**
     * Déposer de l'argent sur le compte
     *
     * @param float $montant Montant déposé
     * @return void
     */
    public function deposer(float $montant)
    {
        // On verifie si le montant est positif
        if ($montant > 0) {
            $this->solde += $montant;
        }
    }

    /**
     * Retourne une chaine de caractères affichant le solde
     *
     * @return string
     */
    public function voirSolde()
    {
        // echo("le solde du compte est de $this->solde €");
        return "le solde du compte est de $this->solde €";
    }

    /**
     * Retire un montant du solde du compte
     *
     * @param float $montant Montant à retirer
     * @return void
     */
    public function retirer(float $montant)
    {
        if ($montant > 0 && $this->solde >= $montant) {
            $this->solde -= $montant;
        } else {
            echo "Montant invalide ou solde insuffisant";
        }
    }
}