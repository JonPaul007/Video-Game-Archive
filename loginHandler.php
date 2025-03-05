<?php
// Start the session to manage user login
session_start();

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize the input values for username and password
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Ensure both username and password are provided
    if (empty($username) || empty($password)) {
        die("Both username and password are required.");
    }

    // Include the database connection file
    require_once "ConnectDB.php";

    try {
        // Prepare a SQL query to fetch the user based on the provided username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(); // Fetch the user record

        // Check if a matching user is found and if the password is correct
        if ($user && password_verify($password, $user['pwd'])) {
            // If login is successful, store user information in session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Redirect the user to the main menu page
            header("Location: mainMenu.php");
            exit; // Ensure no further code is executed after the redirect
        } else {
            // If login fails, redirect to login page with an error message
            header("Location: loginPage.php?error=1");
            exit; // Ensure no further code is executed after the redirect
        }
    } catch (PDOException $e) {
        // If a database error occurs, log the error and display a generic message
        error_log($e->getMessage());
        die("An error occurred. Please try again later.");
    }
} else {
    // If the form wasn't submitted, redirect to login page
    header("Location: loginPage.php");
    exit; // Ensure no further code is executed after the redirect
}
