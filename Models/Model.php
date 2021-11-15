<?php

namespace App\Models;

use App\Db\Db;

Class Model extends Db
{
    // Propriété pour la table de la base de données
    protected $table;
    
    // Propriété pour l'instance de DB
    private $db;

    /**
     * Sélectionne tous les enregistrements d'une table
     *
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        dump($query);
        return $query->fetchAll();
    }

    /**
     * Sélectionne un enregistrement suivant son ID
     *
     * @param integer $id ID de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        // dump($this->requete("SELECT * FROM {$this->table} WHERE id = $id"));
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    /**
     * Sélectionne plusieurs enregistrements suivant un tableau de critères
     *
     * @param array $criteres Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $criteres)
    {
        // exemple : "SELECT * FROM annonces WHERE actif = ?
        // bindValue(':actif', 1)

        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        // var_dump($champs);
        // var_dump($valeurs);

        // On transforme la tableau "champs" en chaîne de caractères séparée par des 'AND'
        $listeChamps = implode(' AND ', $champs);
        // var_dump($listeChamps);

        // On execute la requête
        // dump($this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $listeChamps, $valeurs));
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $listeChamps, $valeurs)->fetchAll();
    }

    /**
     * Insert un enregistrement suivant un tableau de données
     *
     * @param Model $model Objet à créer
     * @return bool
     */
    public function create(Model $model)
    {
        // exemple : INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)

        $champs = [];
        $questionMarks = [];
        $valeurs = [];
        
        // var_dump($model);

        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur) {
            if($valeur !== null && $champ !== "db" && $champ !== "table") {
                $champs[] = $champ;
                $valeurs[] = $valeur;
                $questionMarks[] = "?";
            }
        }
        // dump($champs);
        // dump($valeurs);
        // dump($questionMarks);

        // On transforme le tableau "champs" en une chaine de caractère
        $listeChamps = implode(', ', $champs);
        // dump($listeChamps);

        // On transforme le tableau "questionMark" en une chaine de caractère
        $listeQuestionMark = implode(', ', $questionMarks);
        // dump($listeQuestionMark);

        // On execute la requête
        // dump($this->requete("INSERT INTO {$this->table} ($listeChamps) VALUES ($listeQuestionMark)", $valeurs));
        return $this->requete("INSERT INTO {$this->table} ($listeChamps) VALUES ($listeQuestionMark)", $valeurs);
    }


    /**
     * Met à jour un enregistrement suivant un tableau de données
     *
     * @param integer $id ID de l'enregistrement à modifier
     * @param Model $model Objet à modifier
     * @return bool
     */
    public function update(int $id, Model $model)
    {
        // exemple : UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id = ?

        $champs = [];
        $valeurs = [];
        
        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur) {
            if($valeur !== null && $champ !== "db" && $champ !== "table") {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // dump($champs);
        // dump($valeurs);

        // On transforme le tableau "champs" en une chaine de caractère
        $listeChamps = implode(', ', $champs);
        // dump($listeChamps);


        // On execute la requête
        // dump($this->requete("UPDATE {$this->table} SET $listeChamps WHERE id = ?", $valeurs));
        return $this->requete("UPDATE {$this->table} SET $listeChamps WHERE id = ?", $valeurs);
    }

    /**
     * Supprime un enregistrement
     *
     * @param integer $id iD de l'enregistrment à supprimer
     * @return bool
     */
    public function delete(int $id)
    {
        // exemple : DELETE from annonces WHERE id = ?
        // dump($this->requete("DELETE FROM {$this->table} WHERE id = $id"));
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Hydratation des données
     *
     * @param array $donnees Tableau associatif des données
     * @return self Retourne l'objet hydraté
     */
    public function hydrate(array $donnees)
    {
        // dump($donnees);
        foreach($donnees as $key => $value) {
            // On récupère le nom du SETTER correspondant à l'attribut/la cléf (avec sa 1ère lettre en majuscule)
            $setter = 'set'.ucfirst($key);
            // dump($setter);
            
            // On vérifie que le SETTER existe bien
            if (method_exists($this, $setter)) {
                // On appelle le SETTER
                $this->$setter($value);
            } else {
                echo "KO";
            }
        }
        return $this;
    }

    /**
     * Execute les requêtes
     *
     * @param string $sql Requête SQL à exécuter
     * @param array|null $attributs Attributs à ajouter à la requête
     * @return PDOStatement|false
     */
    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attibuts
        if ($attributs !== null) {
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }
}