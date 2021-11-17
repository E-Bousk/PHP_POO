<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Affiche une page listant toutes les annonces actives de la BDD
     *
     * @return void
     */
    public function index()
    {
        $annonces = (new AnnoncesModel)->findBy(['actif' => 1]);
        
        $this->render('annonces/index', compact('annonces'));
    }

    /**
     * Affiche une page affichant une annonce suivant son ID
     *
     * @param integer $id ID de l'annonce
     * @return void
     */
    public function lire(int $id)
    {
        $annonce = (new AnnoncesModel)->find($id);
        
        $this->render('annonces/lire', compact('annonce'));
    }
    
}