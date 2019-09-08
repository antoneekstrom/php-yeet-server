<?php
    include('http.php');
    include('user.php');
    include('password.php');
    include('database.php');

    $username;
    $password;

    $user_data;
    $db;

    $fetch_user_file = "../sql/fetch_user.sql";

    function login($_username, $_password) {
        global $username, $password;

        $username = $_username;
        $password = $_password;

        if (validate_credentials()) {
            credentials_valid();
        }
        else {
            credentials_invalid();
        }
    }

    function validate_content($username, $password)
    {
        return (isset($username) && strlen($username) > 0 && isset($password) && strlen($password) > 0);
    }

    function validate_credentials() {
        global $username, $password, $user_data, $db;

        if (validate_content($username, $password)) {

            $db = connect_db();
            $user_data = query_user_data($username);

            return verify_password($password, $user_data);
        }
        else return false;
    }

    function query_user_data($username) {
        global $db, $fetch_user_file;

        $q = replace_query_vars(file_get_contents($fetch_user_file), array('$username' => $username));

        return db_query($db, $q)[0];
    }

    function credentials_invalid() {
        $path = 'login_page.php';
        $query = $_GET;
        $query['login_failed'] = 1;
        redirect($path, $query);
    }

    function credentials_valid() {
        global $user_data;
        
        $user_data['password_hash'] = '';
        $user_data['salt'] = '';

        start_session(array('user' => $user_data));
        
        redirect("pages/home_page.php", null);
    }

    function start_session($data) {
        session_start();
        session_regenerate_id(true);
        $_SESSION = $data;
    }

    // attempt to login with credentials
    if (isset_array($_POST, array('username', 'password'))) {
        login($_POST['username'], $_POST['password']);
    }
    else {
        credentials_invalid();
    }
?>