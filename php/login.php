<?php
    include('http.php');
    include('user.php');
    include('password.php');

    $username;
    $password;

    $user_data;
    $db;

    function login($_username, $_password) {
        global $username, $password;

        if (isset($username) && strlen($username) > 0 && isset($password) && strlen($password) > 0) return;

        $username = $_username;
        $password = $_password;

        if (validate_credentials()) {
            credentials_valid();
        }
        else {
            credentials_invalid();
        }
    }

    function validate_credentials() {
        global $username, $password, $user_data, $db;

        $db = connect_db();
        $user_data = query_user_data($username);

        return verify_password($password, $user_data);
    }

    function credentials_invalid() {
        $path = 'pages/login_page.php';
        $query = $_GET;
        $query['login_failed'] = 1;
        redirect($path, $query);
    }

    function credentials_valid() {
        global $user_data;
        
        $user_data = exclude_entries($user_data, array('password_hash', 'salt'));
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