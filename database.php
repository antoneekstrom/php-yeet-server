<?php

    $db_config_file = "dbconfig.json";

    function connect_db() {
        global $db_config_file;
        $config = json_decode(file_get_contents($db_config_file));
        $dbname = $config->{"dbname"};
        $host = $config->{"host"};
        return new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $config->{"user"});
    }

    function db_query($db, $query) {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function replace_query_vars($query, $vars) {
        foreach ($vars as $var => $replacement) {
            $query = str_replace($var, $replacement, $query);
        }
        return $query;
    }
?>