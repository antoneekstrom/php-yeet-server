<?php
    include('../user.php');
    include(resolve_path('php/components/comment.php'));

    if (!try_session()) redirect(resolve_path('php/pages/login_page.php'));

    $name = $_SESSION['user']['username'];
    if (isset($_GET['username'])) {
        $name = $_GET['username'];
    }

    $db = connect_db();
    $user = exclude_entries(query_user_data($name, $db), array('password_hash', 'salt', 'email'));
    $GLOBALS['user'] = $user;
    $GLOBALS['is_own_profile'] = $_SESSION['user']['id'] == $GLOBALS['user']['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        global $user;

        echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">';

        include_scripts(array('comment.js'), '../../js');
        include_styles(array('navbar.css'), '../../css');
        set_page_title($user['username'] . '- Profil');
        include('../page_head.php');
    ?>
    <body>
        <?php
            include('../components/header.php');
        ?>
        <main>
            <h1><?= $GLOBALS['user']['username'] ?></h1>
            <div class="profile-picture-container large">
                <img src=<?= join_paths('../../', $GLOBALS['user']['profile_image']) ?> class="profile-picture">
            </div>
            <div class="row">
                <h2>Profil</h2>
                <?php
                    if ($GLOBALS['is_own_profile']) echo "<a class=\"button\" href=\"account_page.php\">Redigera</a>";
                ?>
            </div>
            <ul>
                <div class="info row">
                    <p class="label">användarnamn:</p>
                    <p><?= $GLOBALS['user']['username'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">förname:</p>
                    <p><?= $GLOBALS['user']['firstname'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">eftername:</p>
                    <p><?= $GLOBALS['user']['lastname'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">födelsedag:</p>
                    <p><?= $GLOBALS['user']['birthday'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">datum skapat:</p>
                    <p><?= $GLOBALS['user']['date_created'] ?></p>
                </div>
            </ul>

            <div class="comments-container">
                <div class="comments">
                    <?php
                        global $db;
                        $q = file_get_contents(resolve_path('sql/fetch_profile_comments.sql'));
                        $params = array(':profile_user_id' => $GLOBALS['user']['id']);
                        $comments = db_query($db, $q, $params);
                        
                        foreach ($comments as $c) {
                            $author = query_user_data(intval($c['author_user_id']), $db);
                            $rating = db_query($db, file_get_contents(resolve_path('sql/fetch_comment_rating.sql')), array(':comment_id' => $c['id']));

                            $is_dislike = 0;
                            if (isset($rating[0])) $is_dislike = $rating[0]['is_dislike'];

                            $comment = array_merge($c, array(
                                'profile_img' => join_paths('../../', $author['profile_image']),
                                'author' => $author['username'],
                                'is_rated' => isset($rating[0]),
                                'is_dislike' => $is_dislike
                            ));
                            
                            echo create_comment($comment);
                        }
                    ?>
                </div>
                <?php
                    if (!$GLOBALS['is_own_profile']) {
                        include(resolve_path('php/components/comment_field.php'));
                    }
                ?>
            </div>
        </main>
    </body>
</html>