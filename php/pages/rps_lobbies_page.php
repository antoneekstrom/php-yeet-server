<?php
    include('../user.php');
    include('../rps_lobby.php');

    if (!try_session()) {
        redirect('login_page.php');
    }

    $db = connect_db();
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
            <h1>VÄLKOMMEN TILL 🤛 ✌ ✋</h1>
            <div class="column field-color">
                <a class="button main" href="rps_page.php">Skapa Lobby</a>
                <form action="rps_page.php" method="get">
                    <div class="small-margin sides">
                        <div class="field-container button">
                            <input data-lpignore="true" type="text" name="id" placeholder="Lobby id" />
                            <input type="submit" class="button main" value="Delta" />
                        </div>
                    </div>
                </form>
            </div>
            <ul>
            <?php
                $template = file_get_contents('../components/lobby_entry_template.html');
                $lobbies = get_lobbies($db);

                if (isset($lobbies) && count($lobbies) > 0) {
                    foreach($lobbies as $l) {

                        $lobj = construct_lobby($db, $l);

                        echo replace_vars($template, array(
                            '$id' => $l['lobby_id'],
                            '$status' => $l['game_status'],
                            '$p1' => $lobj->p1['username'],
                            '$p2' => $lobj->p2['username']
                        ));
                    }
                }
            ?>
            </ul>
        </main>
    </body>
</html>