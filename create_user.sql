-- @block create_user
USE yeet;
INSERT INTO users (
    username,
    firstname,
    lastname,
    password_hash,
    salt,
    birthday,
    profile_image
)
VALUES (
    '$username',
    '$firstname',
    '$lastname',
    '$password_hash',
    '$salt',
    '$birthday',
    '$profile_image'
)
