<?php

    $db_config_file = "dbconfig.json";

    $stmt;

    function connect_db() {
        global $db_config_file;
        $config = json_decode(file_get_contents(resolve_path($db_config_file)));
        $dbname = $config->{"dbname"};
        $host = $config->{"host"};
        return new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $config->{"user"});
    }

    function db_query($db, $query, $params) {
        global $stmt;
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $err = $stmt->errorInfo();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function get_stmt() {
        global $stmt;
        return $stmt;
    }

    function replace_vars($text, $vars) {
        foreach ($vars as $var => $replacement) {
            $text = str_replace($var, $replacement, $text);
        }
        return $text;
    }
?>