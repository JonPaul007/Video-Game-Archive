<?php
// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and clean form data
    $username = trim($_POST["username"]); // Remove unnecessary whitespace from username
    $pwd = $_POST["pwd"]; // Password entered by the user
    $email = trim($_POST["email"]); // Clean the email input

    // Check if any of the fields are empty
    if (empty($username) || empty($pwd) || empty($email)) {
        die("All fields are required."); // Stop and show error message if any field is empty
    }

    // Validate password length (must be at least 6 characters)
    if (strlen($pwd) < 6) {
        die("Password must contain 6 or more characters."); // Error message for short password
    }

    // Validate username length (must be at least 6 characters)
    if (strlen($username) < 6) {
        die("Username must be at least 6 characters long."); // Error message for short username
    }

    // Validate email format using PHP's filter_var function
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format."); // Error message for invalid email
    }

    // Include the database connection file
    require_once "ConnectDB.php";

    try {
        // Check if the username already exists in the database
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);

        // If the username already exists, display an error
        if ($stmt->fetchColumn() > 0) {
            die("Username is already taken. Choose a new one!"); // Error message for taken username
        }

        // Hash the password before storing it securely
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

        // Insert the new user into the users table
        $stmt = $pdo->prepare("INSERT INTO users (username, pwd, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashed_pwd, $email]);

        // Redirect to the login page upon successful registration
        header("Location: loginPage.php");
        exit;
    } catch (PDOException $e) {
        // Log any errors for debugging
        error_log($e->getMessage()); 

        // Redirect to index page with a generic error message
        header("Location: index.php?error=An error occurred. Please try again later.");
        exit;
    }
}
