<!DOCTYPE html>
<html lang="sv">
    <?php
        include('../user.php');
        set_page_title('Skapa Konto');
        include_styles(array('navbar.css'), '../../css');
        include("../page_head.php");
    ?>
    <body>

        <?php
            include('../components/header.php');
        ?>

        <main>
            <?php readfile('../forms/create_user_form.html') ?>
        </main>

    </body>
</html>