-- @block like_comment
UPDATE profile_comments
SET likes = likes + 1
WHERE id = :id;