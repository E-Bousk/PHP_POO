<?php

namespace App\Controllers;

use App\Core\Form;

class UsersController extends Controller
{
    public function login()
    {
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
}