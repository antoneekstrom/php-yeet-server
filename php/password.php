<?php

    function acquire_seasoning() {
        return 'aromat';
    }

    function encrypt($str, $salt, $pepper) {
        return sha1($str . $salt . $pepper);
    }

    function compare_hash($hash, $salt, $pepper, $password) {
        $p = encrypt($password, $salt, $pepper);
        return strcmp($hash, $p);
    }

    function verify_password($password, $user_data) {

        if (!isset($user_data) || count($user_data) == 0) return false;

        $pass_hash = $user_data['password_hash'];
        $salt = $user_data['salt'];

        return compare_hash($pass_hash, $salt, acquire_seasoning(), $password);
    }

?>