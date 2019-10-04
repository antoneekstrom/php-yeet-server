<?php

    include('user.php');

    if (!try_session()) {
        redirect(resolve_path('php/pages/login_page.php'));
    }

    function main_social() {
        $req = '';

        if (isset($_POST['req'])) {
            $req = $_POST['req'];
        }
        else if (isset($_GET['req'])) {
            $req = $_GET['req'];
        }
        else {  
            redirect('./pages/home_page.php');
        }

        switch ($req) {
            case 'comment':
                comment();
                break;
            case 'rate_comment':
                rate_comment();
                break;
        }
    }

    function rate_comment() {
        redirect_if_unset($_GET['id'], 'pages/home_page.php');
        redirect_if_unset($_GET['is_dislike'], 'pages/home_page.php');

        $db = connect_db();
        $params = array(
            ':comment_id' => $_GET['id'],
            ':user_id' => $_SESSION['user']['id'],
            ':is_dislike' => $_GET['is_dislike']
        );

        $r = db_query($db, "SELECT * FROM likes WHERE comment_id= :comment_id AND user_id= :user_id", array(
            ':comment_id' => $_GET['id'],
            ':user_id' => $_SESSION['user']['id']
        ));

        $exists = count($r) > 0; // true
        $dislike = intval($_GET['is_dislike']) == 1; // false
        $same = $exists ? intval($r[0]['is_dislike']) == intval($_GET['is_dislike']) : false; // true

        if (!($exists && !$same)) db_query($db, "DELETE FROM likes WHERE comment_id= :comment_id", array(':comment_id' => $_GET['id']));

        echo json_encode(array('exists' => $exists, 'dislike' => $dislike, 'same' => $same));

        if ((!$exists && $dislike) || ($same && !$dislike)) {
            db_query($db, file_get_contents(resolve_path('sql/dislike_comment.sql')), $params);
        }
        else if ((!$exists && !$dislike) || ($same && $dislike)) {
            db_query($db, file_get_contents(resolve_path('sql/like_comment.sql')), $params);
        }

        if ($same) db_query($db, "DELETE FROM likes WHERE comment_id= :comment_id", array(':comment_id' => $_GET['id']));
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