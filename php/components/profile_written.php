<div class="comments-container">
    <div class="comments">
        <?php
        global $db;
        $q = 'SELECT * FROM profile_comments WHERE author_user_id= :author_user_id';
        $params = array(':author_user_id' => $GLOBALS['user']['id']);
        $comments = db_query($db, $q, $params);

        foreach ($comments as $c) {
            $author = query_user_data(intval($c['profile_user_id']), $db);
            $rating = db_query($db, file_get_contents(resolve_path('sql/fetch_comment_rating.sql')), array(':comment_id' => $c['id']));

            $is_dislike = 0;
            if (isset($rating[0])) $is_dislike = $rating[0]['is_dislike'];

            $comment = array_merge($c, array(
                'profile_img' => join_paths('../../', $author['profile_image']),
                'author' => $author['username'],
                'is_rated' => isset($rating[0]),
                'is_dislike' => $is_dislike
            ));

            echo create_comment($comment);
        }
        ?>
    </div>
</div>