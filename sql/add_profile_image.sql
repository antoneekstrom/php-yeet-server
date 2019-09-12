-- @block upload_profile_image
USE yeet;
UPDATE users
SET profile_image = :profile_image
WHERE id = :id;