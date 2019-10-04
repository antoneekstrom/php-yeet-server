INSERT INTO rps_lobbies (
    lobby_id,
    player1_id,
    player2_id,
    p2_choice,
    p1_choice,
    game_status
)
VALUES (
    :lobby_id,
    :player1_id,
    :player2_id,
    :p2_choice,
    :p1_choice,
    :game_status
);