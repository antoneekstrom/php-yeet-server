<?php
    function request($path, $data, $method = 'GET', $url = 'localhost/') {
        $qualified_url = $url . $path;
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => $method,
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        echo "<h1>url: $qualified_url</h1>";
        $result = file_get_contents($qualified_url, false, $context);
        if ($result === FALSE) {}
    }
?>