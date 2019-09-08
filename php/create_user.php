<?php

    include("database.php");
    include("password.php");
    include("util.php");

    function create_user(
        $username,
        $email,
        $firstname,
        $lastname,
        $password_hash,
        $salt,
        $birthday,
        $profile_image
    ) {

        $vars = array(
            '$username' => $username,
            '$lowercase_username' => strtolower($username),
            '$email' => $email,
            '$firstname' => ucfirst(strtolower($firstname)),
            '$lastname' => ucfirst(strtolower($lastname)),
            '$password_hash' => $password_hash,
            '$salt' => $salt,
            '$birthday' => $birthday,
            '$profile_image' => $profile_image
        );

        $q = replace_query_vars(file_get_contents("../sql/create_user.sql"), $vars);
        $r = db_query(connect_db(), $q);
    }

    if (isset($_POST['create_user']) || isset($_GET['create_user'])) {

        if ($_POST['password'] != $_POST['confirm_password']) {
            redirect('pages/create_user_page.php', array('passwords-not-matching' => 1));
        }

        $salt = random_bytes(64);
        $password_hash = encrypt($_POST['password'], $salt, acquire_seasoning());

        create_user(
            $_POST['username'],
            (isset($_POST['email']) ? $_POST['email'] : null),
            $_POST['firstname'],
            $_POST['lastname'],
            $password_hash,
            $salt,
            $_POST['birthday'],
            null
        );

        redirect('pages/login_page.php', null);
    }

?>