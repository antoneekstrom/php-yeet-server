<?php
    include('util.php');

    function main() {
        if (!isset($_GET['req'])) return;

        $req = $_GET['req'];

        switch ($req) {
            case 'log_out':
                log_out();
                break;
        }
    }

    function try_session() {
        session_start();
        return is_logged_in();
    }

    function is_logged_in() {
        return isset($_SESSION['user']);
    }

    function log_out() {
        session_start();
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            session_abort();
        }
        redirect('login_page.php');
    }

    main();
?>