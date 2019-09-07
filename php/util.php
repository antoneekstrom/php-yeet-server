<?php
    $_URL = dirname(__FILE__);
    $GLOBALS['url'] = $_URL;

    function redirect($path, $params = array()) {
        $url = $path . '?' . http_build_query($params);
        echo "<script type=\"text/javascript\">window.location.href = '$url'</script>";
    }

    function isset_array($array, $keys) {
        foreach ($keys as $key) {
            if (!isset($array[$key])) return false;
        }
        return true;
    }

    // Didn't write this I'm afraid. frick regex, man
    function join_paths() {
        $paths = array();
    
        foreach (func_get_args() as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }
    
        return preg_replace('#/+#', DIRECTORY_SEPARATOR, join(DIRECTORY_SEPARATOR, $paths));
    }
?>