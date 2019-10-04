-- @block create rockpaperscissors lobby table

CREATE TABLE rps_lobbies (
    id INT(8) UNSIGNED auto_increment NOT NULL,
    player1_id INT(8) UNSIGNED NOT NULL,
    player2_id INT(8) UNSIGNED NOT NULL,
    p1_choice VARCHAR(1) NOT NULL,
    p2_choice VARCHAR(1) NOT NULL,
    game_status INT(8) NOT NULL DEFAULT 0,

    PRIMARY KEY (id),
    FOREIGN KEY (player1_id) REFERENCES users(id),
    FOREIGN KEY (player2_id) REFERENCES users(id)
) DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;