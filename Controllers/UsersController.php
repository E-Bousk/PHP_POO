<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{
    /**
     * Connexion des utilisateurs
     *
     * @return void
     */
    public function login()
    {
        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['email', 'password'])) {
            // On va chercher dans la BDD l'utilisateur avec l'email saisi
            $user = new UsersModel;

            $userArray= $user->findOneByEmail(strip_tags($_POST['email']));

            // Si l'utilisateur n'existe pas
            if(!$userArray) {
                // On envoie un message de session
                $_SESSION['error'] = "L'adresse e-mail et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }

            // L'utilisateur existe
            /**
             * @var UserModel
             */
            $user = $user->hydrate($userArray);

            // On vérifie si le mot de passe est correct
            if(password_verify($_POST['password'], $user->getPassword())){
                // Le mot de passe est bon, on crée la session
                $user->setSession();
                // et on redirige sur la page d'accueil
                header('Location: /');
                exit;
            } else {
                // mauvais mot de passe
                $_SESSION['error'] = "L'adresse e-mail et/ou le mot de passe est incorrect";
                header('Location: /users/login');
                exit;
            }

        }

        $form = new Form;

        $form->startForm()
            ->adLabelFor("email", "E-mail :")
            ->adInput("email", "email", ['id' => 'email', 'class' => 'form-control'])
            ->adLabelFor("pass", "Mot de passe :")
            ->adInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->adButton('Me connecter', ['class' => 'mt-3 btn btn-primary'])
            ->endForm()
        ;

        $this->render('users/login', ['loginForm' => $form->create()]);
    }

    /**
     * Inscription des utilisateurs
     *
     * @return void
     */
    public function register()
    {
        // On verifie que tous les champs soient remplis
        if(Form::validate($_POST, ['email', 'password'])) {
            // On 'nettoie' l'adresse mail (on supprime toutes les balises HTML et PHP)
            $email = strip_tags($_POST['email']);

            // On chiffre le mot de passe
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

            // On hydrate l'utilisateur
            $user = new UsersModel;
            $user->setEmail($email)
                ->setPassword($password)
            ;

            // On enregistre l'utilisateur dans la BDD
            $user->create();
        } 

        $form = new Form;

        $form->startForm()
            ->adLabelFor("email", "E-mail :")
            ->adInput("email", "email", ['id' => 'email', 'class' => 'form-control'])
            ->adLabelFor("pass", "Mot de passe :")
            ->adInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->adButton('M\'inscrire', ['class' => 'mt-3 btn btn-primary'])
            ->endForm()
        ;

        $this->render('users/register', ['registerForm' => $form->create()]);
    }

    /**
     * Déconnexion de l'utilisateur
     *
     * @return exit
     */
    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}