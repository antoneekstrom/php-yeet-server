<?php

    class Lobby {

        public $id;

        public $p1;
        public $p2;

        public $p1c;
        public $p2c;

        public $status;
        public $winner;

        public $choices = array('🤛', '✋', '✌');

        public function __construct($id) {
            $this->id = $id;
        }

        /**
         * Check if the lobby is ready to start.
         */
        public function ready() {
            return isset($this->p2) && isset($this->p1) && $this->status == 0;
        }

        /**
         * Check if both players are ready to play the game.
         */
        public function done() {
            return isset($this->p2c) && isset($this->p1c) && $this->status == 1;
        }

        /**
         * Start the game if the lobby is ready. Let's the players pick a choice.
         */
        public function start() {
            if ($this->ready()) {
                $this->status = 1;
            }
        }

        /**
         * Get the index of a choice.
         */
        private function indexOf($choice) {
            return array_search($choice, $this->choices);
        }

        /**
         * Get the choice that wins against the argument choice.
         */
        private function winningChoice($choice) {
            return ($this->indexOf($choice) + 1) % 3;
        }

        /**
         * Play the game, calculate the result.
         */
        public function play() {
            if (!$this->done()) return;

            $p1 = $this->p1c;
            $p2 = $this->p2c;
            
            if ($p1 == $p2)
                $this->winner = 'tie'; // specialfall om båda har valt samma
            else
                $this->winner = ($p1 == $this->winningChoice($p2)) ? $p1 : $p2;
        }

        /**
         * Pick a choice as a user.
         */
        public function choose($player, $choice) {
            if ($this->status != 1) return;

            if ($player == 1) $this->p1c = $choice;
            else if ($player == 2) $this->p2c = $choice;

            $this->play();
        }

        /**
         * Join the lobby as a user.
         */
        public function join($user) {
            if (!isset($this->p2) && $this->status == 0) {
                $this->p2 = $user;
            }
        }
    }

    $GLOBALS['lobbies'] = array();

    function lobby_path($id) {
        return resolve_path("data/lobby_$id.json");
    }

    function create_lobby($db, $user, $id = null) {
        $l = new Lobby($id == null ? rand_hex(4) : $id);
        $l->p1 = $user;
        $l->status = 0;

        $GLOBALS['lobbies'][$l->id] = $l;
        $user['rps_lobby'] = $l;

        $q = file_get_contents(resolve_path('sql/create_rpslobby.sql'));
        $params = array(
            ':lobby_id' => $l->id,
            ':player1_id' => intval($l->p1['id']),
            ':player2_id' => intval($l->p1['id']),
            ':p2_choice' => $l->p2c,
            ':p1_choice' => $l->p1c,
            ':game_status' => $l->status
        );
        $r = db_query($db, $q, $params);

        return $l;
    }

    function construct_lobby($db, $data) {
        $l = new Lobby($data['lobby_id']);
        $l->p1 = query_user_data(intval($data['player1_id']), $db);
        $l->p2 = query_user_data(intval($data['player2_id']), $db);
        $l->status = $data['game_status'];
        $l->p1c = $data['p1_choice'];
        $l->p2c = $data['p2_choice'];
        return $l;
    }

    function get_lobbies($db) {
        $r = db_query($db, 'SELECT * FROM rps_lobbies;', null);
        return $r;
    }

    function destroy_lobby($db, $id) {
        $q = 'DELETE FROM rps_lobbies WHERE lobby_id=:id';
        $params = array(':id' => $id);
        db_query($db, $q, $params);
    }

    function find_lobby($db, $id) {
        $r = db_query($db, 'SELECT * FROM rps_lobbies WHERE lobby_id=:lobby_id', array(':lobby_id' => $id));
        return count($r) > 0 ? $r[0] : null;
    }

?>