<?php
    include('../user.php');
    include('../search.php');

    if (!try_session()) redirect(resolve_path('php/pages/login_page.php'));
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        global $user;

        include_scripts(array('search_page.js'), '../../js/');
        include_styles(array('navbar.css'), '../../css');
        set_page_title($user['username'] . '- Profil');
        include('../page_head.php');
    ?>
    <body>
        <?php
            include('../components/header.php');
        ?>
        <main>
            <div class="search-container row">
                <?php readfile(resolve_path('php/components/search_user.html')); ?>
            </div>
            <ol id="search-results">
                <?php
                    if (isset($_GET['input'])) {
                        $results = search_users($_GET['input']);
                        $template = file_get_contents('../components/search_result_template.html');

                        foreach ($results as $r) {
                            $vars = array(
                                '$username' => $r['username'],
                                '$date_created' => $r['date_created'],
                                '$fullname' => user_fullname($r),
                                '$img' => join_paths('../../', $r['profile_image'])
                            );
                            $item = replace_vars($template, $vars);
                            echo $item;
                        }
                    }
                ?>
            </ol>
        </main>
    </body>
</html>