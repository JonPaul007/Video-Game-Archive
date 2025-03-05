<?php
// Include database login credentials and connection settings
require_once 'DBlogin.php';

try {
    // Establish a new PDO database connection
    $pdo = new PDO($attr, $user, $pass, $opts);

    // SQL statement to create the 'users' table if it does not already exist
    $usersTable = "
        CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user
            username VARCHAR(50) NOT NULL,           -- Username (required)
            pwd VARCHAR(255) NOT NULL,               -- Hashed password (required)
            email VARCHAR(255),                      -- Email (optional)
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Timestamp of account creation
        )";

    // SQL statement to create the 'games' table if it does not already exist
    $gamesTable = "
        CREATE TABLE IF NOT EXISTS games (
            game_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each game
            title VARCHAR(100) NOT NULL,             -- Game title (required)
            description TEXT,                        -- Game description (optional)
            release_date DATE NOT NULL,              -- Official release date (required)
            platform VARCHAR(50),                    -- Platform (e.g., PC, PlayStation, Xbox)
            publisher VARCHAR(100),                  -- Publisher of the game
            region ENUM('Global', 'North America', 'Japan') DEFAULT 'Global', -- Region availability
            anticipated_release_date DATE,           -- Expected release date for upcoming games
            image_url VARCHAR(255)                   -- URL to game cover image
        )";

    // SQL statement to create the 'personal_library' table if it does not already exist
    $personalLibraryTable = "
        CREATE TABLE IF NOT EXISTS personal_library (
            library_id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each entry
            user_id INT NOT NULL,                      -- Reference to the 'users' table
            game_id INT NOT NULL,                      -- Reference to the 'games' table
            added_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Timestamp of when the game was added
            FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE, -- Delete library entries if user is removed
            FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE  -- Delete library entries if game is removed
        )";

    // Execute table creation queries
    $pdo->exec($usersTable);
    $pdo->exec($gamesTable);
    $pdo->exec($personalLibraryTable);

    echo "Tables created successfully.";
} catch (PDOException $e) {
    // Handle errors and terminate script if table creation fails
    die("Setup failed: " . $e->getMessage());
}
