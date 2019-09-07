-- @block create_user
USE yeet;
INSERT INTO users (
    username,
    username_lowercase,
    firstname,
    lastname,
    password_hash,
    salt,
    birthday,
    profile_image
)
VALUES (
    '$username',
    '$lowercase_username',
    '$firstname',
    '$lastname',
    '$password_hash',
    '$salt',
    '$birthday',
    '$profile_image'
)
