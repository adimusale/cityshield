<?php
/**
 * Optional 1-Click MySQL Setup Script
 * Access this script in your browser (e.g. http://localhost/citycompanion/database/setup_mysql.php)
 * to automatically create the database and import schema + seed data into MySQL!
 */

$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = '';
$dbName = 'cityshield';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CityShield - MySQL Database Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 p-8 font-sans">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-md border border-slate-200">
        <h1 class="text-2xl font-bold text-slate-900 mb-2">CityShield &bull; MySQL Database Setup</h1>
        <p class="text-xs text-slate-500 mb-6">Creates MySQL database <code><?= htmlspecialchars($dbName) ?></code> on <code><?= htmlspecialchars($host) ?>:<?= htmlspecialchars($port) ?></code> and seeds initial Delhi NCR data.</p>

        <?php
        try {
            // Connect to MySQL server without selecting database
            $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // Create database
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            echo "<div class='p-3 bg-emerald-50 text-emerald-800 rounded-lg text-xs font-semibold mb-2'>&check; Database `$dbName` created or already exists.</div>";

            // Switch to database
            $pdo->exec("USE `$dbName`;");

            // Execute schema
            $schemaFile = __DIR__ . '/schema.sql';
            if (file_exists($schemaFile)) {
                $schemaSql = file_get_contents($schemaFile);
                $pdo->exec($schemaSql);
                echo "<div class='p-3 bg-emerald-50 text-emerald-800 rounded-lg text-xs font-semibold mb-2'>&check; Schema tables created successfully.</div>";
            }

            // Execute seed
            $seedFile = __DIR__ . '/seed.sql';
            if (file_exists($seedFile)) {
                $seedSql = file_get_contents($seedFile);
                $pdo->exec($seedSql);
                echo "<div class='p-3 bg-emerald-50 text-emerald-800 rounded-lg text-xs font-semibold mb-2'>&check; Delhi NCR pilot seed data imported successfully!</div>";
            }

            echo "<div class='mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-900 space-y-2'>
                <p><strong>Next Step:</strong> Edit <code>config/db.php</code> and set:</p>
                <code class='block bg-white p-2 rounded border border-blue-200 font-mono text-blue-800'>define('DB_DRIVER', 'mysql');</code>
                <a href='../index.php' class='inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition'>Go to Website &rarr;</a>
            </div>";

        } catch (PDOException $e) {
            echo "<div class='p-4 bg-red-50 text-red-800 rounded-xl text-xs space-y-2 border border-red-200'>
                <strong class='font-bold block text-sm'>Setup Failed:</strong>
                <p>" . htmlspecialchars($e->getMessage()) . "</p>
                <p class='text-slate-500 mt-2'>Note: If MySQL / XAMPP is not running, the application automatically uses <strong>SQLite</strong> with zero configuration required!</p>
            </div>";
        }
        ?>
    </div>
</body>
</html>
