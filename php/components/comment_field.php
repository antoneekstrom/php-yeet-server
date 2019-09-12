<div class="comment-field-container">
    <form class="comment-field-form" method="post" action="../social.php">
        <textarea rows="5" placeholder="Skriv Kommentar" class="comment-field" name="comment"></textarea>
        <input type="hidden" name="req" value="comment">
        <input type="hidden" name="id" value="<?= $GLOBALS['user']['id'] ?>">
        <input type="submit" value="Publicera">
    </form>
</div>