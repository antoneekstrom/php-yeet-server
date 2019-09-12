<?php
    include('util.php');
    include('database.php');

    $GLOBALS['unsafe_user_fields'] = array('password_hash', 'salt');
    $GLOBALS['fetch_user_file'] = 'sql/fetch_user.sql';
    $GLOBALS['add_profile_image'] = 'sql/add_profile_image.sql';

    function main_user() {

        $req = '';

        if (!isset($_GET['req'])) {
            if (isset($_POST['req'])) {
                $req = $_POST['req'];
            }
            else return;
        }
        else {
            $req = $_GET['req'];
        }

        switch ($req) {
            case 'log_out':
                log_out();
                break;
            case 'upload_profile_image':
                upload_profile_image();
                break;
        }
    }

    function upload_profile_image() {

        if (!try_session()) return;

        $file = $_FILES['profile_image'];
        $filename = $file['name'];
        $dir = '../uploads/profile_images';
        $path = join_paths($dir, $filename);

        $stored_path = join_paths('uploads/profile_images', $filename);
        $stored_path = str_replace('\\', '\\\\', $stored_path);
        $stored_path = str_replace('.', '\.', $stored_path);

        print_r($_FILES);
        $success = move_uploaded_file($file['tmp_name'], $path);
        if ($success) {
            $db = connect_db();
            $q = file_get_contents(resolve_path($GLOBALS['add_profile_image']));
            $id = $_SESSION['user']['id'];
            $params = array(':id' => $id, ':profile_image' => $stored_path);
            db_query($db, $q, $params);
        }
    }

    function query_user_data($name_or_id, $db, $fields = 'all') {

        if (!isset($db)) $db = connect_db();

        $param = is_integer($name_or_id) ? 'id' : 'username';
        $q = "SELECT * FROM users WHERE $param= :param";
        $r = db_query($db, $q, array(':param' => $name_or_id))[0];

        if ($fields != 'all') {
            return extract_entries($r, $fields);
        }
        else return $r;
    }

    function try_session() {
        session_start();
        $in = is_logged_in();

        if ($in) {
            $_SESSION['user'] = exclude_entries(query_user_data($_SESSION['user']['username'], connect_db()), $GLOBALS['unsafe_user_fields']);
        }

        return $in;
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
        redirect('pages/login_page.php');
    }

    if (!isset($GLOBALS['disable_user_main']))
        main_user();
?>