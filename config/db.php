<?php
/**
 * Database Configuration & Connection Handler
 * Supports both SQLite (zero-config, works out of the box) and MySQL.
 */

// Configuration
define('DB_DRIVER', 'sqlite'); // Options: 'sqlite' or 'mysql'

// MySQL Credentials (used if DB_DRIVER is 'mysql')
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'cityshield');
define('DB_USER', 'root');
define('DB_PASS', '');

// SQLite Path
define('SQLITE_FILE', __DIR__ . '/../database/cityshield.sqlite');

function getDBConnection() {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    try {
        if (DB_DRIVER === 'sqlite') {
            $dbDir = dirname(SQLITE_FILE);
            if (!is_dir($dbDir)) {
                mkdir($dbDir, 0777, true);
            }
            $isNew = !file_exists(SQLITE_FILE) || filesize(SQLITE_FILE) === 0;
            $pdo = new PDO('sqlite:' . SQLITE_FILE);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Enable foreign keys in SQLite
            $pdo->exec('PRAGMA foreign_keys = ON;');

            if ($isNew) {
                initializeDatabase($pdo, 'sqlite');
            }
        } else {
            // MySQL
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $pdo;
    } catch (PDOException $e) {
        // Fallback to SQLite if MySQL fails
        if (DB_DRIVER === 'mysql') {
            try {
                $pdo = new PDO('sqlite:' . SQLITE_FILE);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                initializeDatabase($pdo, 'sqlite');
                return $pdo;
            } catch (Exception $fallbackEx) {
                die("Database Error: " . $fallbackEx->getMessage());
            }
        }
        die("Database Connection Failed: " . $e->getMessage());
    }
}

/**
 * Auto-initializes schema and initial seed data if SQLite file is fresh.
 */
function initializeDatabase($pdo, $driver = 'sqlite') {
    $schemaFile = __DIR__ . '/../database/schema.sql';
    $seedFile = __DIR__ . '/../database/seed.sql';

    if (file_exists($schemaFile)) {
        $sql = file_get_contents($schemaFile);
        $pdo->exec($sql);
    }

    if (file_exists($seedFile)) {
        $seedSql = file_get_contents($seedFile);
        $pdo->exec($seedSql);
    }
}
