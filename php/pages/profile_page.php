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
                        $comments = db_query($db, $q, array(':profile_user_id' => $GLOBALS['user']['id']));
                        
                        foreach ($comments as $c) {
                            $author = query_user_data(intval($c['author_user_id']), $db);
                            echo create_comment($author['username'], $c['text'], join_paths('../../', $author['profile_image']), $c['date_created']);
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