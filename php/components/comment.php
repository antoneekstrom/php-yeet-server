<?php
    function create_comment($author, $text, $profile_img, $date_created) {
        $html = file_get_contents(resolve_path('php/components/comment_template.html'));
        return replace_vars($html, array('$author' => $author, '$text' => $text, '$date_created' => $date_created, '$img' => $profile_img));
    }
?>