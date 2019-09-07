<?php
    include('http.php');
    include('util.php');
    include('password.php');
    include('database.php');

    $username;
    $password;

    $user_data;

    $db;

    $fetch_user_file = "fetch_user.sql";

    function login($_username, $_password) {
        global $username, $password;
        $username = $_username;
        $password = $_password;

        $valid = validate_credentials();
        if ($valid) {
            credentials_valid();
        }
        else {
            credentials_invalid();
        }
    }

    function validate_credentials() {
        global $username, $password;

        $valid_content = (isset($username) && strlen($username) > 0 && isset($password) && strlen($password) > 0);

        if ($valid_content) {
            return verify_password($username, $password);
        }
        else return false;
    }

    function verify_password($username, $password) {
        global $user_data;

        $user_data = query_user_data($username);
        if (!isset($user_data) || count($user_data) == 0) return false;
        $user_data = $user_data[0];

        $pass_hash = $user_data['password_hash'];
        $salt = $user_data['salt'];

        return compare_hash($pass_hash, $salt, acquire_seasoning(), $password);
    }

    function query_user_data($username) {
        global $db, $fetch_user_file;
        $db = connect_db();

        $q = file_get_contents($fetch_user_file);
        $q = str_replace('$username', $username, $q);

        $stmt = $db->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function credentials_invalid() {
        $path = 'login_page.php';
        $query = $_GET;
        $query['login_failed'] = 1;
        redirect($path, $query);
    }

    function credentials_valid() {
        session_start();
        $user_data['password_hash'] = '';
        $user_data['salt'] = '';
        $_SESSION['user'] = $user_data;
        redirect("home_page.php", null);
    }

    // attempt to login with credentials
    if (isset($_POST['username']) && isset($_POST['password'])) {
        login($_POST['username'], $_POST['password']);
    }
    else {
        credentials_invalid();
    }
?>