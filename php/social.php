<?php

    include('user.php');

    if (!try_session()) {
        redirect(resolve_path('php/pages/login_page.php'));
    }

    function main_social() {
        redirect_if_unset($_POST['req'], './pages/home_page.php');

        $req = $_POST['req'];

        switch ($req) {
            case 'comment':
                comment();
                break;
        }
    }
    
    function comment() {
        redirect_if_unset($_POST['comment'], './pages/home_page.php');
        redirect_if_unset($_POST['id'], './pages/home_page.php');

        $db = connect_db();

        $q = file_get_contents(resolve_path('sql/add_comment.sql'));
        $params = array(
            ':text' => $_POST['comment'],
            ':profile_user_id' => $_POST['id'],
            ':author_user_id' => $_SESSION['user']['id'],
        );
        db_query($db, $q, $params);
        $name = db_query($db, "SELECT username FROM users WHERE id=:id", array(':id' => $_POST['id']));
        redirect('pages/profile_page.php', array('username' => $name[0]['username']));
    }

    main_social();
?>