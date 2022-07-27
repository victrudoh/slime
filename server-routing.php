<?php


$requestedpage = $_SERVER["REQUEST_URI"];

switch ($requestedpage) {
    case '/':
        include 'index.php';
        break;
    case '':
        include 'index.php';
        break;
    case '/slime/feed':
        include 'feed.php';
        break;
    case '/slime/register':
        include 'register.php';
        break;
    case '/slime/login':
        include 'login.php';
        break;
    case '/slime/add':
        include 'newpost.php';
        break;
    case '/slime/about':
        include 'about.php';
        break;
    default:
        http_response_code(404);
        include '404.php';
        break;
}
