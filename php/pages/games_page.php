<?php
    include('../user.php');

    if (!try_session()) {
        redirect('login_page.php');
    }
?>
<!DOCTYPE html>
<html lang="sv">
    <?php
        set_page_title("Spel");
        include_styles(array('navbar.css'), '../../css');
        include("../page_head.php"); 
    ?>
    <body>
        <?php
            include('../components/header.php');
        ?>
        <main>
            <h1>Spel</h1>
            <p>På den här sidan förekommer en lista med spelbara spel.</p>
            <nav class="small-margin height">
                <a class="notlink" href="rps_lobbies_page.php"><h2 class="button">🤛✌✋</h2></a>
            </nav>
        </main>
    </body>
</html>