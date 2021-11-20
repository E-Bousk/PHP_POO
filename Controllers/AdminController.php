<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AdminController extends Controller
{
    public function index()
    {
        // On vérifie si l'utilisateur a le role admin
        if($this->isAdmin()) {
            $this->render('admin/index', [], 'admin');
        }
    }

    /**
     * Affiche la liste des annonces sous forme de tableau
     *
     * @return void
     */
    public function annonces()
    {
        if($this->isAdmin()) {
            $annonces = (new AnnoncesModel)->findAll();

            $this->render('admin/annonces', compact('annonces'), 'admin');
        }
    }

    /**
     * Supprime une annonce suivant son ID si on est ROLE ADMIN
     *
     * @param integer $id ID de l'annonce à supprimer
     * @return void
     */
    public function supprimeAnnonce(int $id)
    {
        if($this->isAdmin()) {
            (new AnnoncesModel)->delete($id);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }


    /**
     * Active ou désactive une annonce
     *
     * @param integer $id
     * @return void
     */
    public function activeAnnonce(int $id)
    {
        if($this->isAdmin()) {
            
            $annonceModel = new AnnoncesModel;
            $annonceArray = $annonceModel->find($id);

            if($annonceArray) {
                /** @var AnnoncesModel */
                $annonce = $annonceModel->hydrate($annonceArray);

                // if($annonce->getActif()) {
                //     $annonce->setActif(0);
                // } else {
                //     $annonce->setActif(1);
                // }
                // remplacé par cet opérateur ternaire :
                $annonce->setActif($annonce->getActif() ? 0 : 1);
                
                $annonce->update();
            }
        }
    }

    /**
     * Vérifie si on est ADMIN
     *
     * @return boolean
     */
    private function isAdmin() 
    {
        // On vérifie si on est connecté et si ADMIN est dans les rôles
        if(isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
            return true;
        } else {
            $_SESSION['error'] = "Vous n'avez pas accès à cette partie du site";
            header('Location: /');
            exit;
        }
    }
}