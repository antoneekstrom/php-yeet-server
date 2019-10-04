<?php
    include('../user.php');

    if (!try_session()) {
        redirect('login_page.php');
    }

    include('../rps_lobby.php');

    $db = connect_db();

    if (!isset($_GET['id'])) {
        $l = create_lobby($db, $_SESSION['user']);
        redirect('rps_page.php', array('id' => $l->id));
    }

    $id = $_GET['id'];
    $l = find_lobby($db, $id);

    if ($l == null) die();
    
    $l = construct_lobby($db, $l);
    $_SESSION['rps_lobby'] = $l;

    if (isset($_GET['destroy'])) {
        destroy_lobby($db, $l->id);
        redirect('rps_lobbies_page.php');
    }
?>
<!DOCTYPE html>
<html lang="sv">
    <?php
        set_page_title('🤛 ✌ ✋');
        include_styles(array('navbar.css', 'rps.css'), '../../css');
        include_scripts(array('rps.js'), '../../js');
        include("../page_head.php");
    ?>
    <body>
        <?php
            include('../components/header.php');
        ?>
        <main>
            <h1>🤛 ✌ ✋</h1>
            <h2>L O B B Y</h2>
            <ul>
                <h3>ID: <?= $id ?></h3>
                <h3>Player 1: <?= $l->p1['username'] ?></h3>
                <h3>Player 2: <?= $l->p2['username'] ?></h3>
            </ul>
            <a class="button" href="rps_page.php?destroy&id=<?= $l->id ?>">FÖRSTÖR LOBBY</a>
        </main>
    </body>
</html>