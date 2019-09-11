<?php
    include('../user.php');

    if (!try_session()) {
        redirect('login_page.php');
    }

    function random_greeting() {
        $r = mt_rand(0, 10) / 10;
        $username = $_SESSION['user']['username'];
        $fullname = user_fullname($_SESSION['user']);
        return ($r < 0.5) ? "HEJ PÅ DIG, $username." : "Var hälsad, $fullname.";
    }
?>
<!DOCTYPE html>
<html lang="sv">
    <?php
        set_page_title("Home Page");
        include_styles(array('navbar.css'), '../../css');
        include("../page_head.php"); 
    ?>
    <body>
        <?php
            include('../components/header.php');
        ?>
        <main>
            <h1><?= random_greeting() ?></h1>
        </main>
    </body>
</html>