-- @block create_user
USE yeet;
INSERT INTO users (
    username,
    username_lowercase,
    email,
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
    '$email',
    '$firstname',
    '$lastname',
    '$password_hash',
    '$salt',
    '$birthday',
    '$profile_image'
)
