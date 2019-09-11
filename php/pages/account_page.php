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
        <form id="upload_profile_image_form" enctype="multipart/form-data" action="user.php" method="POST">
            <label for="upload_profile_image" class="file-upload-button">
                <p>Upload Profile Picture</p>
            </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
            <input type="hidden" name="req" value="upload_profile_image" />
            <input type="file" name="profile_image" id="upload_profile_image" accept="image/png, image/jpeg">
        </form>
        <img src="<?= join_paths('../../', $_SESSION['user']['profile_image']) ?>">
    </body>
</html>