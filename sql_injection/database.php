<?php
function getDatabase(): PDO
{
    $databaseDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'database';
    if (!is_dir($databaseDirectory)) {
        mkdir($databaseDirectory, 0777, true);
    }

    $pdo = new PDO('sqlite:' . $databaseDirectory . DIRECTORY_SEPARATOR . 'lab.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT NOT NULL UNIQUE, password TEXT NOT NULL)');
    $pdo->exec('CREATE TABLE IF NOT EXISTS products (id INTEGER PRIMARY KEY, name TEXT NOT NULL, category TEXT NOT NULL, price INTEGER NOT NULL, is_public INTEGER NOT NULL DEFAULT 1)');
    $pdo->exec('CREATE TABLE IF NOT EXISTS category_products (id INTEGER PRIMARY KEY, name TEXT NOT NULL, category TEXT NOT NULL, price INTEGER NOT NULL, is_public INTEGER NOT NULL DEFAULT 1)');

    $pdo->exec("INSERT OR IGNORE INTO users (id, username, password) VALUES
        (1, 'student01', 'training-password-01'),
        (2, 'student02', 'training-password-02'),
        (3, 'admin', 'admin-training-password')");
    $pdo->exec("INSERT OR IGNORE INTO products (id, name, category, price, is_public) VALUES
        (1, 'Web Security Handbook', 'Books', 250000, 1),
        (2, 'Lab Notebook', 'Stationery', 120000, 1),
        (3, 'Security Training USB', 'Accessories', 350000, 1),
        (999, 'Internal Security Package', 'Internal', 0, 0)");
    $pdo->exec("INSERT OR IGNORE INTO category_products (id, name, category, price, is_public) VALUES
        (1, 'Web Security Handbook', 'books', 250000, 1),
        (2, 'Secure Coding Guide', 'books', 180000, 1),
        (3, 'Lab Notebook', 'stationery', 120000, 1),
        (4, 'Security Training USB', 'accessories', 350000, 1),
        (900, 'Internal Red Team Manual', 'internal', 0, 0)");

    return $pdo;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
