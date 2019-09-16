-- @block session
ALTER TABLE profile_comments
ADD likes INT(8) UNSIGNED NOT NULL,
ADD dislikes INT(8) UNSIGNED NOT NULL;
