-- @block add_comment
USE yeet;
INSERT INTO profile_comments (
    profile_user_id,
    author_user_id,
    text
)
VALUES (
    :profile_user_id,
    :author_user_id,
    :text
)