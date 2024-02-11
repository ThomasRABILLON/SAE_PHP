<?php

use App\Models\Classe\Utilisateur;
use App\Models\DataBase\Connection;

function register($post)
{
    if ($post) {
        Connection::insertUser($post['nom'], $post['prenom'], $post['dateNaissance'], password_hash($post['mdp'], PASSWORD_DEFAULT));
        header('Location: /login');
    }
    require 'templates/register.php';
}

function login($post)
{
    if ($post) {
        $user = Connection::getUser($post['nom'], $post['mdp']);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: /');
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