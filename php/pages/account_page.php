<?php
    include('../user.php');

    if (!try_session()) {
        redirect('login_page.php');
    }
?>
<!doctype html>
<html lang="sv">
    <?php
        set_page_title("My Account");
        include_styles(array('navbar.css'), '../../css');
        include_scripts(array('account_page.js', 'user.js'), '../../js');
        include_file('php/page_head.php');
    ?>
    <body>
        <?php include_file('php/components/header.php'); ?>

        <main>
            <h1>Mitt konto</h1>
    
            <h2>Info</h2>
            <ul>
                <div class="info row">
                    <p class="label">username:</p>
                    <p><?= $_SESSION['user']['username'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">förname:</p>
                    <p><?= $_SESSION['user']['firstname'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">eftername:</p>
                    <p><?= $_SESSION['user']['lastname'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">email:</p>
                    <p><?= $_SESSION['user']['email'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">födelsedag:</p>
                    <p><?= $_SESSION['user']['birthday'] ?></p>
                </div>
                <div class="info row">
                    <p class="label">datum skapat:</p>
                    <p><?= $_SESSION['user']['date_created'] ?></p>
                </div>
            </ul>

            <div class="info row">
                <p class="label">profilbild:</p>
                <div class="profile-picture-container large">
                    <img class="profile-picture" src="<?= join_paths('../../', $_SESSION['user']['profile_image']) ?>">
                </div>
            </div>
    
            <form id="upload_profile_image_form" enctype="multipart/form-data" action="user.php" method="POST">
                <label for="upload_profile_image" class="file-upload button">Upload Profile Picture</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                <input type="hidden" name="req" value="upload_profile_image" />
                <input type="file" name="profile_image" id="upload_profile_image" accept="image/png, image/jpeg">
            </form>

            <a class="button" href="../user.php?req=log_out">Log Out</a>
        </main>
    </body>
</html>