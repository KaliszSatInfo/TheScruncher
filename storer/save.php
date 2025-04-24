<?php
session_start();

if (!isset($_SESSION['liked'])) {
    $_SESSION['liked'] = [];
}

if (isset($_POST['liked_image'])) {
    $liked_image = $_POST['liked_image'];
    if (!in_array($liked_image, $_SESSION['liked'])) {
        $_SESSION['liked'][] = $liked_image;
    }
}

header('Location: index.php');
exit;