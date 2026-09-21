<?php
$files = [
    101 => ['owner_id' => 1001, 'path' => 'students/student01/report.txt'],
    102 => ['owner_id' => 1002, 'path' => 'students/student02/report.txt'],
    103 => ['owner_id' => 1, 'path' => 'admin/audit.txt'],
];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!isset($files[$id])) {
    http_response_code(404);
    exit('File not found');
}

// Deliberately incomplete: the lab requires checking both ownership and role.
$path = __DIR__ . '/files/' . $files[$id]['path'];
header('Content-Type: text/plain; charset=utf-8');
readfile($path);
