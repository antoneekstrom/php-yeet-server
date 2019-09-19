-- @block session
UPDATE profile_comments
SET likes = 0;

DELETE FROM likes;