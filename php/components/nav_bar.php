<div class="nav-bar-outer row">
    <div class="nav-bar-inner">
        <div class="title">
            <h2 class="nav-bar-title">PHP-yeet-server</h2>
        </div>
            <?php
                if (is_logged_in()) {
                    include('nav_logged_in.php');
                }
                else {
                    echo
                    '<div class="center row start">
                        <a class="button" href="login_page.php">Logga In</a>
                    </div>';
                }
                ?>
    </div>
</div>