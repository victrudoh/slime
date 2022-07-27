<?php

// session_start();

if (isset($_SESSION['username'])) {
    include 'feed.php';
    // header("Location: feed.php");
} else {
    include 'register.php';
    // header("Location: register.php");
}
