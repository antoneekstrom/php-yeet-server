<?php

    $GLOBALS['root_dir'] = 'E:\Files\php\php-yeet-server';

    function redirect($path, $params = array(), $use_js = false) {
        $url = $path . '?' . http_build_query($params);

        if ($use_js) {
            echo "<script type=\"text/javascript\">window.location.href = '$url'</script>";
        }
        else {
            header("Location: $url");
        }
    }

    function user_fullname($user) {
        return $user['firstname'] . ' ' . $user['lastname'];
    }

    function set_page_title($title) {
        $GLOBALS['title'] = $title;
    }

    function str_append($str, $add, $end = true) {
        $str = ($end ? ($str . $add) : ($add . $str));
        return $str;
    }

    function extract_entries($array, $keys) {
        $result = array();
        foreach ($keys as $k) {
            if (isset($array[$k])) {
                $result[$k] = $array[$k];
            }
        }
        return $result;
    }

    function exclude_entries($array, $keys) {
        $result = $array;
        foreach ($keys as $k) {
            unset($result[$k]);
        }
        return $result;
    }

    function include_file($file) {
        include(resolve_path($file));
    }

    function include_scripts($scripts, $dir) {
        for ($i = 0; $i < count($scripts); $i++) {
            $scripts[$i] = join_paths($dir, $scripts[$i]);
        }
        $GLOBALS['scripts'] = $scripts;
    }

    function include_styles($styles, $dir) {
        for ($i = 0; $i < count($styles); $i++) {
            $styles[$i] = join_paths($dir, $styles[$i]);
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

    function resolve_path($file, $relative = true) {
        return join_paths($GLOBALS['root_dir'], $file);
    }
?>