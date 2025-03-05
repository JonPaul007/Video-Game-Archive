=<?php
// Include database credentials from a separate file for security
require_once 'DBlogin.php';

try {
    // Establish a new PDO database connection using the provided credentials
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    // kill the script and display an error message if the connection fails
    die("Database connection failed: " . $e->getMessage());
}
