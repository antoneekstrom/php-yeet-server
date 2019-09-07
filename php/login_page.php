<?php
    include('user.php');

    if (try_session()) {
        redirect('home_page.php');
    }
?>

<!DOCTYPE html>
<html lang="sv">
    <?php $GLOBALS['title'] = 'Login Page'; include("page_head.php"); ?>
    <body>

        <header>
            <h1>YEEEEEEEEEEEEEEEEET</h1>
        </header>

        <?php
            if (isset($_GET['login_failed']) && $_GET['login_failed'] == 1) {
                echo '<h2 class="warning">Password or username was invalid.</h2>';
            }
        ?>

        <main>
            <?php include("login_form.php") ?>
            <button onClick="window.location.href='create_user_page.php'">Create Account</button>
        </main>

    </body>
</html>