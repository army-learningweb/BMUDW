<?php
$filename = $_GET['file'] ?? '';
$filename = str_replace('../', '', $filename);
$path = __DIR__ . '/files/public/' . $filename;

if ($filename === '' || !is_file($path)) {
    http_response_code(404);
    exit('File not found');
}

header('Content-Type: text/plain; charset=utf-8');
readfile($path);
