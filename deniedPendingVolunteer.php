<?php
    session_cache_expire(30);
    session_start();

    /*if ($_SESSION['access_level'] < 2 || $_SERVER['REQUEST_METHOD'] != 'POST') {
        header('Location: index.php');
        die();
    }*/

    require_once('database/dbPersons.php');
    require_once('include/input-validation.php');
    $args = sanitize($_POST);
    $id = $args['id'];

    if (!$id) {
        header('Location: index.php');
        die();
    }
    if (denied_volunteer_application($id)) {
        header('Location: pending_volunteers.php?pendingSignupSuccess');
        die();
    }
    header('Location: index.php');
?>