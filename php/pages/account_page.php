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
        include_scripts(array('account_page.js', 'user.js'));
        include('../page_head.php');
    ?>
    <body>
        <label for="upload_profile_image" class="file-upload-button">
            <p>Upload Profile Picture</p>
        </label>
        <input type="file" id="upload_profile_image" accept="image/png, image/jpeg">
        <img width=800 height=800 id="img">
    </body>
</html>