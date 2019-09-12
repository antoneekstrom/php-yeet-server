<?php

    $GLOBALS['root_dir'] = join_paths($_SERVER['DOCUMENT_ROOT'], 'php-yeet-server');

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

    function resolve_path($file) {
        return join_paths($GLOBALS['root_dir'], $file);
    }

    function redirect_if_unset($val, $path) {
        if (!isset($val)) {
            redirect($path);
        }
    }

    function getRelativePath($from, $to) {
        // some compatibility fixes for Windows paths
        $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
        $to   = is_dir($to)   ? rtrim($to, '\/') . '/'   : $to;
        $from = str_replace('\\', '/', $from);
        $to   = str_replace('\\', '/', $to);

        $from     = explode('/', $from);
        $to       = explode('/', $to);
        $relPath  = $to;

        foreach($from as $depth => $dir) {
            // find first non-matching dir
            if($dir === $to[$depth]) {
                // ignore this directory
                array_shift($relPath);
            } else {
                // get number of remaining dirs to $from
                $remaining = count($from) - $depth;
                if($remaining > 1) {
                    // add traversals up to first matching dir
                    $padLength = (count($relPath) + $remaining - 1) * -1;
                    $relPath = array_pad($relPath, $padLength, '..');
                    break;
                } else {
                    $relPath[0] = './' . $relPath[0];
                }
            }
        }
        return implode('/', $relPath);
    }
?>