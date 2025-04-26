<?php

function route($path, $params = []) {
    $base = '/';
    
    $url = $base . ltrim($path, '/');

    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}
