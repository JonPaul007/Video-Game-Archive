<?php
// Start the session to manage user authentication
session_start();

// Include database connection
require_once "connectDB.php";

// Check if the user is logged in; if not, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginPage.php"); // Redirect to login
    exit;
}

// Ensure that the request method is POST (only allow deletion through form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $game_id = $_POST['game_id']; // Get the game ID from the form submission

    try {
        // Prepare SQL statement to remove the game from the user's personal library
        $stmt = $pdo->prepare("DELETE FROM personal_library WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$user_id, $game_id]); // Execute the query with provided user and game IDs

        // Redirect back to personal library page with success message
        header("Location: plFront.php?success=removed");
        exit;
    } catch (PDOException $e) {
        // Log the error message for debugging
        error_log($e->getMessage());

        // Redirect with an error message if database operation fails
        header("Location: plFront.php?error=database");
        exit;
    }
} else {
    // Redirect if the script is accessed without a POST request
    header("Location: plFront.php");
    exit;
}
