<?php

use App\Models\DataBase\Connection;

function profil($post)
{
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
    }
    if ($post) {
        $user = $_SESSION['user'];
        $user->setNom($post['nom'] == '' ? $user->getNom() : $post['nom']);
        $user->setPrenom($post['prenom'] == '' ? $user->getPrenom() : $post['prenom']);
        $user->setDateNaissance($post['dateNaissance'] == '' ? $user->getDateNaissance() : date_create($post['dateNaissance']));
        Connection::updateUser($user);
        $_SESSION['user'] = $user;
    }
    require 'templates/profil.php';
}