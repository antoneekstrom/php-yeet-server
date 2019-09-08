<?php
    include('util.php');

    function main() {

        $req = '';

        if (!isset($_GET['req'])) {
            if (isset($_POST['req'])) {
                $req = $_GET['req'];
            }
            else return;
        }
        else {
            $req = $_GET['req'];
        }

        echo $req;

        switch ($req) {
            case 'log_out':
                log_out();
                break;
            case 'upload_profile_image':
                upload_profile_image("php://input");
                break;
        }
    }

    function upload_profile_image($url) {
        echo $url;
        $r = file_get_contents($url);
        $data = json_decode($r);
        $file = fopen('yeet.txt', "w");
        fwrite($file, $data['data']);
        fclose($file);
        echo r . "\n" . var_dump($data);
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