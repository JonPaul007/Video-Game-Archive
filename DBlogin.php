<?php
// Database connection settings
$host = 'localhost';      // Database host (usually 'localhost' for local development)
$data = 'bcs350fa24';     // Name of the database
$user = 'userfa24';       // Database username
$pass = 'pwdfa24';        // Database password
$chrs = 'utf8mb4';        // Character set to ensure proper encoding support

// Data Source Name (DSN) for PDO connection
$attr = "mysql:host=$host;dbname=$data;charset=$chrs";

// PDO options for secure and optimized database interactions
$opts = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements for security
];