<?php
    function create_comment($comment) {
        $html = file_get_contents(resolve_path('php/components/comment_template.html'));
        return replace_vars($html, array(
            '$id' => $comment['id'],
            '$liked' => ($comment['is_dislike'] != 1 && $comment['is_rated']) ? 'active' : '',
            '$disliked' => ($comment['is_dislike'] == 1 && $comment['is_rated']) ? 'active' : '',
            '$author' => $comment['author'],
            '$text' => $comment['text'],
            '$date_created' => $comment['date_created'],
            '$img' => $comment['profile_img'],
            '$likes' => $comment['likes']
        ));
    }
?>