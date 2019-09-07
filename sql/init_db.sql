-- @block init
CREATE TABLE users (
    id INT(8) UNSIGNED AUTO_INCREMENT KEY,
    username VARCHAR(32) NOT NULL,
    username_lowercase VARCHAR(32) NOT NULL,
    email VARCHAR(64),
    firstname VARCHAR(32) NOT NULL,
    lastname VARCHAR(32) NOT NULL,
    password_hash VARCHAR(128) NOT NULL,
    salt VARCHAR(64) NOT NULL,
    birthday DATE,
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    profile_image VARCHAR(32)
) CHARSET=UTF8
