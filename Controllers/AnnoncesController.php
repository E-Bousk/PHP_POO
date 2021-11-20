<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;
use DateTime;

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

    /**
     * Ajouter une annonce
     *
     * @return void
     */
    public function ajouter()
    {
        // On vérifie si l'utilisateur est connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            // On vérifie si le formulaire est complet
            if(Form::validate($_POST, ['titre', 'description'])) {
                // On se protège contre les failles XSS (strip_tags, htmlentities, htmlspecialchars)
                $title = strip_tags($_POST['titre']);
                $descr = strip_tags($_POST['description']);

                // On instancie notre modèle
                $annonce = new AnnoncesModel;
                // On hydrate
                $annonce->setTitre($title)
                        ->setDescription($descr)
                        ->setUsers_id($_SESSION['user']['id'])
                ;
                
                // On enregistre dans la BDD
                $annonce->create();

                // On redirige
                $_SESSION['success'] = "Votre annonce a bien été enregistrée";
                header('Location: /');
                exit;
            } else {
                // *** On cherche quel champ est vide et on récupère sa cléf
                // foreach($_POST as $key => $value) {
                //     if(empty($value)) {
                //         $missing = $key;
                //     }
                // }
                // Le formulaire est incomplet, et on affiche quelle clef n'a pas som champ rempli
                // $_SESSION['error'] = !empty($_POST) ? "Il manque le champs : " . $missing : ''; ***

                // Le formulaire est incomplet
                $_SESSION['error'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
                // On récupère ce qui à potentiellement été saisi afin de le ré-injecté à la création du (nouveau) formulaire
                $title = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
                $descr = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }


            // On crée notre formulaire
            $form = new Form;
            
            // --- Exemple avec un upload de fichier (image) ---
            // $form->startForm('post', "#", ['enctype' => 'multpart/formdata'])
            $form->startForm('post', "#", ['enctype' => 'multpart/formdata'])
                ->adLabelFor('titre', 'Titre de l\'annonce :')
                ->adInput('text', 'titre', [
                    'id' => 'titre',
                    'class' => 'form-control',
                    // Re-affiche ce qui avait été potentiellement déjà saisi (tout comme "$descr" plus bas)
                    'value' => $title
                    ])
                ->adLabelFor('description', 'Description de l\'annonce')
                ->adTextArea('description',$descr, ['id' => 'description', 'class' => 'form-control'])
                // --- Exemple de champ IMAGE ---
                // ->adLabelFor('image', 'Image de l\'annonce :')
                // ->adInput('file', 'image', [
                //     'id' => 'image',
                //     'class' => 'form-control',
                //     ])
                ->adButton('Ajouter', ['class' => 'mt-3 btn btn-primary'])
                ->endForm()
            ;

            $this->render('annonces/ajouter', ['form' => $form->create()]);

        } else {
            $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page";
            header('Location: /users/login');
            exit;
        }
    }

    /**
     * Modifier une annonce
     *
     * @param integer $id ID de l'annonce à modifier
     * @return void
     */
    public function modifier(int $id)
    {
        // On vérifie si l'utilisateur est connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
             
            // On verifie que l'annonce à modifier existe dans la BDD
            $annonce = (new AnnoncesModel)->find($id);
            
            if(!$annonce) {
                http_response_code(404);
                $_SESSION['error'] = "Cette annonce n'existe pas";
                header('Location: /annonces');
                exit;
            }
            
            // On vérifie si l'utilisateur est le rédacteur de l'annonce
            if($annonce->users_id !== $_SESSION['user']['id']) {
                $_SESSION['error'] = "Vous n'avez pas les droits sur cette annonce";
                header('Location: /annonces');
                exit;
            }

            // On traite le formulaire
            if(Form::validate($_POST, ['titre', 'description'])) {
                // On se protège contre les failles XSS (strip_tags, htmlentities, htmlspecialchars)
                $title = strip_tags($_POST['titre']);
                $descr = strip_tags($_POST['description']);

                // On stock l'annonce
                $annonceModif = new AnnoncesModel;

                $annonceModif->setId($annonce->id)
                            ->setTitre($title)
                            ->setDescription($descr)
                ;

                // On met à jour l'annonce
                $annonceModif->update();

                // On redirige
                $_SESSION['success'] = "Votre annonce a bien été modifiée";
                header('Location: /');
                exit;
            }

            // On crée notre formulaire
            $form = new Form;
            $form->startForm()
                ->adLabelFor('titre', 'Titre de l\'annonce :')
                ->adInput('text', 'titre', [
                    'id' => 'titre',
                    'class' => 'form-control',
                    'value' => $annonce->titre
                ])
                ->adLabelFor('description', 'Texte de l\'annonce')
                ->adTextArea('description', $annonce->description, [
                    'id' => 'description',
                    'class' => 'form-control'
                ])
                ->adButton('Modifier', ['class' => 'mt-3 btn btn-primary'])
                ->endForm()
            ;

            // On envoie à la vue
            $this->render('annonces/modifier', ['form' => $form->create(), "id" => $id]);

        } else {
            $_SESSION['error'] = "Vous devez vous connecter pour modifier une annonce";
            header('Location: /users/login');
            exit;
        }
    }
}