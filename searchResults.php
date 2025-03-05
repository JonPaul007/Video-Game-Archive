<?php
session_start(); // Start the session to manage user state
require_once "connectDB.php"; // Include the database connection file

// Check if the search query is set and not empty
if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    echo "<p style='text-align: center; color: red;'>Please enter a search term.</p>"; // Error message if query is empty
    exit; // Exit if there's no search term
}

$searchTerm = trim($_GET['query']); // Get and clean the search term

try {
    // Prepare the SQL statement to search for games by title
    $stmt = $pdo->prepare("
        SELECT game_id, title, description, release_date, platform, image_url 
        FROM games 
        WHERE title LIKE ?
    ");
    // Execute the statement with the search term as a parameter (wildcards for partial match)
    $stmt->execute(['%' . $searchTerm . '%']);
    $results = $stmt->fetchAll(); // Fetch all results

    // If no results are found, show a message
    if (empty($results)) {
        echo "<p style='text-align: center; color: red;'>No games match or are similar to the one you were looking for.</p>";
    }
} catch (PDOException $e) {
    error_log($e->getMessage()); // Log any database errors for troubleshooting
    die("<p style='text-align: center; color: red;'>Error searching for games. Please try again later.</p>"); // Display a generic error message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make the page responsive -->
    <title>Search Results</title> <!-- Page title -->
    <style>
        body {
            background-color: black; /* Dark background for the page */
            color: white; /* White text color */
            font-family: Arial, sans-serif; /* Use a basic sans-serif font */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add padding to the page */
        }

        h1 {
            text-align: center; /* Center-align the heading */
        }

        .results-container {
            display: flex; /* Use flexbox for layout */
            flex-wrap: wrap; /* Allow items to wrap to the next line */
            gap: 20px; /* Space between items */
            justify-content: center; /* Center-align the items */
        }

        .game-cart {
            border: 1px solid white; /* White border around each game card */
            border-radius: 10px; /* Rounded corners */
            padding: 10px; /* Padding inside each card */
            width: 300px; /* Set a fixed width for each card */
            background-color: #1a1a1a; /* Dark background for each card */
            text-align: center; /* Center-align text inside the card */
        }

        .game-cart img {
            width: 100%; /* Make the image fill the width of the card */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 10px; /* Round the image corners */
        }

        .game-cart h3 {
            margin: 10px 0; /* Add margin around the title */
            font-size: 1.5rem; /* Set font size for the title */
            color: #f0db4f; /* Set a golden color for the title */
        }

        .back-button {
            text-align: center; /* Center-align the back button */
            margin-top: 20px; /* Add space above the button */
        }

        .back-button button {
            background-color: #28a745; /* Green background for the button */
            color: white; /* White text on the button */
            border: none; /* Remove button border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px 20px; /* Add padding to the button */
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .back-button button:hover {
            background-color: #218838; /* Darken the button color on hover */
        }
    </style>
</head>
<body>
    <h1>Search Results for "<?php echo htmlspecialchars($searchTerm); ?>"</h1> <!-- Display search term -->
    <div class="results-container">
        <?php if (!empty($results)): ?> <!-- Check if there are results -->
            <?php foreach ($results as $game): ?> <!-- Loop through each game -->
                <div class="game-cart">
                    <img src="<?php echo htmlspecialchars($game['image_url'] ?: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png'); ?>" alt="<?php echo htmlspecialchars($game['title']); ?>"> <!-- Display game image with fallback -->
                    <h3><?php echo htmlspecialchars($game['title']); ?></h3> <!-- Display game title -->
                    <p><strong>Platform:</strong> <?php echo htmlspecialchars($game['platform']); ?></p> <!-- Display game platform -->
                    <p><strong>Release Date:</strong> <?php echo htmlspecialchars($game['release_date']); ?></p> <!-- Display release date -->
                    <p><?php echo htmlspecialchars($game['description']); ?></p> <!-- Display game description -->
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="back-button">
        <a href="mainMenu.php" style="text-decoration: none;"> <!-- Link back to main menu -->
            <button>Back to Main Menu</button> <!-- Back button -->
        </a>
    </div>
</body>
</html>
