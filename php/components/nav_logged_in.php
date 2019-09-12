<div class="center row start">
    <div class="navigation">
        <nav>
            <a class="button" href="home_page.php">Hem</a>
            <a class="button" href="../user.php?req=log_out">Logga ut</a>
        </nav>
    </div>
    <?php readfile(resolve_path('php/components/search_user.html')); ?>
</div>
<?php include('account_preview.php'); ?>