<div class="nav-bar-outer">
    <div class="nav-bar-inner">
        <div class="title">
            <h2 class="nav-bar-title">PHP-yeet-server</h2>
        </div>
        <div class="content"></div>
        <div class="navigation">
            <nav>
                <ul>
                </ul>
            </nav>
        </div>
        <?php
            if (is_logged_in()) {
                include('profile_logged_in.php');
            }
            else {
                include('profile_logged_off.php');
            }
        ?>
    </div>
</div>