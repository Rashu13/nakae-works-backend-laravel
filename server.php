<?php

/**
 * Laravel - Router script for PHP built-in development server
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

$filePath = __DIR__ . '/public' . $uri;

// If static asset exists inside public directory, serve it directly with correct headers
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
    $mimeTypes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
    ];

    if (isset($mimeTypes[$extension])) {
        header("Content-Type: {$mimeTypes[$extension]}");
    } else {
        $mime = mime_content_type($filePath);
        if ($mime) {
            header("Content-Type: {$mime}");
        }
    }

    readfile($filePath);
    exit;
}

require_once __DIR__ . '/public/index.php';
