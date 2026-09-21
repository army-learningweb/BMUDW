<?php
$files = [
    101 => ['owner_id' => 1001, 'path' => 'student01/report.txt'],
    102 => ['owner_id' => 1002, 'path' => 'student02/report.txt'],
];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!isset($files[$id])) {
    http_response_code(404);
    exit('File not found');
}

// Intentionally missing: authorization that compares owner_id with the current user.
$path = __DIR__ . '/files/' . $files[$id]['path'];
header('Content-Type: text/plain; charset=utf-8');
readfile($path);
