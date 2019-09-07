<?php
    $_URL = dirname(__FILE__);
    $GLOBALS['url'] = $_URL;

    function redirect($path, $params) {
        global $_URL;

        $url = $path . '?' . http_build_query($params);
        echo "<script type=\"text/javascript\">window.location.href = '$url'</script>";
    }

    function join_paths() {
        $paths = array();
    
        foreach (func_get_args() as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }
    
        return preg_replace('#/+#', DIRECTORY_SEPARATOR, join(DIRECTORY_SEPARATOR, $paths));
    }
?>