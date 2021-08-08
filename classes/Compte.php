<?php
/**
 * Objet compte bancaire
 */
class Compte
{
    // Propriétés
    /**
     * Titulaire du compte
     *
     * @var string
     */
    private string $titulaire;

    /**
     * Solde du compte
     *
     * @var float
     */
    private float $solde;

    // Constantes
    const TAUX_INTERETS= 5;

    // Méthodes
    /**
     * Constructeur du compte bancaire
     *
     * @param string $nom Nom du titulaire
     * @param float $montant Montant du solde du titulaire
     */
    public function __construct(string $nom, float $montant = 100)
    {
        // On attribue le nom à la propriété titulaire de l'instance créée
        $this->titulaire = $nom;
        
        // On attribue le montant à la propriété solde
        $this->solde= $montant + ($montant * self::TAUX_INTERETS/100);
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
     * @return string
     */
    public function getTitulaire(): string
    {
        return $this->titulaire;
    }

    /**
     * Modifie le nnom du titulaire et reourne l'objet
     *
     * @param string $nom Nom du titulaire
     * @return Compte Compte bancaire
     */
    public function setTitulaire(string $nom): self
    {
        // On verifie si on a un titulaire
        if ($nom != "") {
            $this->titulaire= $nom;
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
        echo $this->decouvert();
    }

    /**
     * Verifie si le compte est négatif ou pas
     *
     * @return string
     */
    private function decouvert()
    {
        if($this->solde < 0) {
            return "Vous êtes à découvert";
        } else {
            return "Vous avez $this->solde €";
        }
    }



}