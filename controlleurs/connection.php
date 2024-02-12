<?php

use App\Models\Classe\Utilisateur;
use App\Models\Builder;
use App\Models\DataBase\Connection;

function register($post)
{
    if ($post) {
        if (Connection::getUser($post['email']))
        {
            $error = "Utilisateur déjà existant";
        } else {
            Connection::insertUser($post['email'], $post['nom'], $post['prenom'], $post['dateNaissance'], password_hash($post['mdp'], PASSWORD_DEFAULT));
            header('Location: /login');
        }
    }
    require 'templates/register.php';
}

function login($post)
{
    if ($post) {
        $user = Connection::getUser($post['email']);
        if ($user) {
            if (password_verify($post['mdp'], $user['mdp']))
            {
                session_start();
                $_SESSION['user'] = Builder::createUserFromDatabase($user);
                header('Location: /');
            } else {
                $error = "Mot de passe incorrect";
            }
        } else {
            $error = "Email inconnu";
        }
    }
    require 'templates/login.php';
}

function logout()
{
    session_start();
    session_destroy();
    header('Location: /login');
}