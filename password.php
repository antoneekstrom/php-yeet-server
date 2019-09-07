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

?>