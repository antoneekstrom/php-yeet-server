<?php
    function search_users($input) {
        $db = connect_db();
        $query = "SELECT * FROM users WHERE username LIKE :username";
        $input = '%' . $input . '%';
        $result = db_query($db, $query, array(':username' => $input));
        return $result;
    }
?>