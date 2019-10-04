-- @block like_comment
USE yeet;

UPDATE profile_comments
SET likes = likes - 1
WHERE id = :comment_id;

INSERT INTO likes (
    comment_id,
    user_id,
    is_dislike
)
VALUES (
    :comment_id,
    :user_id,
    1
);