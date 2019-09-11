<?php

    $db_config_file = "dbconfig.json";

    function connect_db() {
        global $db_config_file;
        $config = json_decode(file_get_contents(resolve_path($db_config_file)));
        $dbname = $config->{"dbname"};
        $host = $config->{"host"};
        return new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $config->{"user"});
    }

    function db_query($db, $query) {
        $stmt = $db->prepare($query);
        $stmt->execute();
        $r = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    function replace_query_vars($query, $vars) {
        foreach ($vars as $var => $replacement) {
            $query = str_replace($var, $replacement, $query);
        }
        return $query;
    }
?>