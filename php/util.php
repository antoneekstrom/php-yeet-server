<?php
    $_URL = dirname(__FILE__);
    $GLOBALS['url'] = $_URL;

    function redirect($path, $params = array(), $use_js = false) {
        $url = $path . '?' . http_build_query($params);

        if ($use_js) {
            echo "<script type=\"text/javascript\">window.location.href = '$url'</script>";
        }
        else {
            header("Location: $url");
        }
    }

    function set_page_title($title) {
        $GLOBALS['title'] = $title;
    }

    function str_append($str, $add, $end = true) {
        $str = ($end ? ($str . $add) : ($add . $str));
        return $str;
    }

    function include_scripts($scripts) {
        for ($i = 0; $i < count($scripts); $i++) {
            $scripts[$i] = str_append($scripts[$i], '../js/', false);
        }
        $GLOBALS['scripts'] = $scripts;
    }

    function include_styles($styles) {
        for ($i = 0; $i < count($styles); $i++) {
            $styles[$i] = str_append($styles[$i], '../css/', false);
        }
        $GLOBALS['styles'] = $styles;
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