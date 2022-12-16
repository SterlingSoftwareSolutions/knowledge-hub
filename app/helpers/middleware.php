<?php

function usersOnly($redirect = '/index.php')
{
 if(empty ($_SESSION['id'])){
        $_SESSION['message'] = 'You need to login first';
        $_SESSION['type'] = 'error';
        header('location: ' .  $redirect);
        exit(0);
 }
}

function adminOnly($redirect = './index.php')
{
    if(  empty($_SESSION['admin'])){
        $_SESSION['message'] = 'You need not authorized';
        $_SESSION['type'] = 'error';
        header('location: '. "http://localhost/blog/");
        exit(0);
 }
}

function guestOnly($redirect = '/index.php')
{
 if (isset($_SERVER['id'])){
    header('location: ' . $BASE_URL . $redirect);
    exit(0);
 }
}
