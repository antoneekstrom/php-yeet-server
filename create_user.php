<?php

    include("database.php");
    include("password.php");
    
    function create_user(
        $username,
        $firstname,
        $lastname,
        $password_hash,
        $salt,
        $birthday,
        $profile_image
    ) {
        $vars = array(
            '$username' => $username,
            '$firstname' => $firstname,
            '$lastname' => $lastname,
            '$password_hash' => $password_hash,
            '$salt' => $salt,
            '$birthday' => $birthday,
            '$profile_image' => $profile_image
        );
        $q = replace_query_vars(file_get_contents("create_user.sql"), $vars);
        print_r($q);
        $result = db_query(connect_db(), $q);
    }

    if (isset($_POST['create_user'])) {
        $salt = random_bytes(64);
        $password_hash = encrypt($_POST['password'], $salt, acquire_seasoning());

        create_user(
            $_POST['username'],
            $_POST['firstname'],
            $_POST['lastname'],
            $password_hash,
            $salt,
            $_POST['birthday'],
            null
        );
    }

?>