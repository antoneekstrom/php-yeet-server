-- @block create_table_likes
CREATE TABLE likes (
    id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    comment_id INT(8) UNSIGNED NOT NULL,
    user_id INT(8) UNSIGNED NOT NULL,
    is_dislike BIT(1) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (comment_id) REFERENCES profile_comments(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
)