-- @block like_comment
USE yeet;

DELETE FROM likes WHERE comment_id= :comment_id;

UPDATE TABLE profile_comments
SET likes = l