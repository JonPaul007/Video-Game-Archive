<?php
// Start the session to track user login status
session_start();

// Include database connection file
require_once "connectDB.php";

// Check if the user is logged in; if not, stop running 
if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in first.");
}

// Check if the request method is POST (ensures data is being sent properly)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $game_id = $_POST['game_id']; // Get the game ID from the form submission

    try {
        // Check if the game is already in the user's personal library
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM personal_library WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$user_id, $game_id]);

        // If the game already exists, redirect with an error message
        if ($stmt->fetchColumn() > 0) {
            header("Location: centralLibrary.php?error=duplicate");
            exit;
        }

        // Insert the game into the user's personal library
        $stmt = $pdo->prepare("INSERT INTO personal_library (user_id, game_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $game_id]);

        // Redirect back to the library with a success message
        header("Location: centralLibrary.php?success=added");
        exit;
    } catch (PDOException $e) {
        // Log database errors for debugging
        error_log($e->getMessage());

        // Redirect with a database error message
        header("Location: centralLibrary.php?error=database");
        exit;
    }
} else {
    // If the request method is not POST, redirect back to the library
    header("Location: centralLibrary.php");
    exit;
}
