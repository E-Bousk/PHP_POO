<?php

namespace App\Core;

class Form
{
    private $formcode = '';

    /**
     * Génère le formulaire HTML
     *
     * @return string
     */
    public function create()
    {
        return $this->formcode;
    }

    /**
     * Valide si tous les champs proposés sont remplis
     *
     * @param array $form Tableau issu du formulaire ($_POST, $_GET)
     * @param array $champs Tableau listant les champs obligatoires
     * @return bool
     */
    public static function validate(array $form, array $champs)
    {
        // On parcout les champs
        foreach($champs as $champ) {
            // Si le champ est absent ou vide dans le formulaire
            if (!isset($form[$champ]) || empty($form[$champ])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Ajoute les attributs envoyés à la balise
     *
     * @param array $attributs Tableau associatif ['class' => 'form-control', 'required' => true]
     * @return string Chaine de caractères générée
     */
    private function addAttributs(array $attributs): string
    {
        // On initialise une chaîne de caractères
        $str = '';

        // On liste les attributs sans valeur
        $noValue = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // On boucle sur le tableau d'attribut
        foreach($attributs as $attribut => $value) {
            // Si l'attribut est dans la liste des atttibuts sans valeur
            if(in_array($attribut, $noValue) && $value == true) {
                // On l'ajoute
                $str .= " $attribut";
            } else {
                // On ajoute « attribut = "valeur" »
                // <!> On met des « double quote » pour pouvoir utiliser un apostrophe le cas échéant
                $str .= " $attribut=\"$value\"";
            }
        }
        return $str;
    }

    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $method Méthode du formulaire (POST ou GET)
     * @param string $action Action du formulaire
     * @param array $attributs Attributs du formulaire
     * @return Form
     */
    public function startForm(string $method = "post", string $action = "#", array $attributs = []): self
    {
        // On ouvre la balise FORM
        $this->formcode .= "<form action='$action' method='$method'";

        //On ajoute les attributs éventuels et on ferme la balise
        $this->formcode .= $attributs ? $this->addAttributs($attributs) . ">" : ">";
        
        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return Form
     */
    public function endForm(): self
    {
        // // EXEMPLE de token : On crée un token
        // $token = md5(uniqid());
        // // On l'ajoute dans notre formulaire
        // $this->formcode .= "<input type='hidden' name='token' value='$token'>";
        // // On stock le token dans la SESSION
        // $_SESSION['token'] = $token;
        
        // On ajoute la balise fermante
        $this->formcode .= "</form>";
        return $this;
    }

    /**
     * Ajout d'un label
     *
     * @param string $for
     * @param string $text
     * @param array $attributs
     * @return Form
     */
    public function adLabelFor(string $for, string $text, array $attributs = []):self
    {
        // On ouvre la balise LABEL
        $this->formcode .= "<label for='$for'";

        // On ajoute les attributs éventuels
        $this->formcode .= $attributs ? $this->addAttributs($attributs) : '';

        // On ferme la balise, on ajoute le texte et la balise fermante
        $this->formcode .= ">$text</label>";

        return $this;
    }

    /**
     * Ajout d'un champ INPUT
     *
     * @param string $type Type de l'input
     * @param string $name Nom de l'input
     * @param array $attributs Attributs
     * @return Form
     */
    public function adInput(string $type, string $name, array $attributs = []): self
    {
        // On ouvre la balise INPUT
        $this->formcode .= "<input type='$type' name='$name'";

        // On ajoute les attributs éventuels et on ferme la balise
        $this->formcode .= $attributs ? $this->addAttributs($attributs) . '>' : '>';

        return $this;
    }

    /**
     * Ajout d'un champ TEXTAREA
     *
     * @param string $name Nom du champ
     * @param string $value Valeur du champ
     * @param array $attributs Attributs
     * @return Form
     */
    public function adTextArea(string $name, string $value = '', array $attributs = []): self
    {
        // On ouvre la balise TEXTAREA
        $this->formcode .= "<textarea name='$name'";

        // On ajoute les attributs éventuels
        $this->formcode .= $attributs ? $this->addAttributs($attributs) : '';

        // On ferme la balise, on ajoute la valeur et la balise fermante
        $this->formcode .= ">$value</textarea>";

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $name Nom du champ
     * @param array $options Liste des options
     * @param array $attributs Attributs
     * @return Form
     */
    public function adSelect(string $name, array $options, array $attributs = []): self
    {
        // On ouvre la balise SELECT
        $this->formcode .= "<select name='$name'";

        // On ajoute les attributs éventuels et on ferme la balise
        $this->formcode .= $attributs ? $this->addAttributs($attributs) . '>' : '>';

        // On ajoute chacune des options
        foreach($options as $valeur => $text) {
            $this->formcode .= "<option value=\"$valeur\">$text</option>";
        }

        // On ajoute la balise fermante
        $this->formcode .= "</select>";
 
        return $this;
    }

    /**
     * Ajoute un bouton
     * @param string $text Texte du bouton
     * @param array $attributs Attributs 
     * @return Form
     */
    public function adButton(string $text, array $attributs = []):self
    {
        // On ouvre la balise BUTTON
        $this->formcode .= "<button ";
        
        // On ajoute les attributs eventuels
        $this->formcode .= $attributs ? $this->addAttributs($attributs) : '';

        // On ajoute le texte et la balise fermante
        $this->formcode .= ">$text</button>";

        return $this;
    }
}