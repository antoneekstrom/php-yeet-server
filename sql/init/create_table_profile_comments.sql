CREATE TABLE profile_comments (
    id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    profile_user_id INT(8) UNSIGNED NOT NULL,
    author_user_id INT(8) UNSIGNED NOT NULL,
    text TEXT(4096),
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (profile_user_id) REFERENCES users(id),
    FOREIGN KEY (author_user_id) REFERENCES users(id)
) CHARSET=UTF8