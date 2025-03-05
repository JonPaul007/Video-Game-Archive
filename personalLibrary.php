<?php
// Start the session to access session variables
session_start();

// Include the database connection
require_once "connectDB.php";

// Retrieve the user_id from session
$user_id = $_SESSION['user_id'];

try {
    // Prepare the SQL query to get the user's personal library data
    $stmt = $pdo->prepare("
        SELECT g.game_id, g.title, g.platform, g.publisher,
        g.image_url
        FROM personal_library pers
        JOIN games g ON pers.game_id = g.game_id
        WHERE pers.user_id = ?");

    // Execute the query with the current user's ID
    $stmt->execute([$user_id]);

    // Fetch all the results (the user's games in the library)
    $games = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle any exceptions and display an error message
    die("<div style='color: red; font-weight: bold;'>We encountered an issue. Please try again later.</div>");
}

// Now, you can use the $games array to display the user's personal library
?>
