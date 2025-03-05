<?php
// Start the session to track user login status
session_start();

// Include database connection file
require_once "connectDB.php";

try {
    // Fetch all games from the database with relevant details
    $stmt = $pdo->query("SELECT game_id, title, description, release_date, platform, image_url FROM games");
    $games = $stmt->fetchAll(); // Store results in an array
} catch (PDOException $e) {
    // Display an error message if the database query fails
    die("Error fetching games: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Library</title>

    <!-- Google Font for platform styling -->
    <link href="https://fonts.googleapis.com/css2?family=Doto:wght@100..900&display=swap" rel="stylesheet">

    <style>
        /* General page styling */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Grid container for games */
        .library-setting {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* Individual game card styling */
        .game-cart {
            border: 1px solid white;
            border-radius: 10px;
            padding: 15px;
            width: 300px;
            background-color: #1a1a1a;
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Game cover image styling */
        .game-cart img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }

        /* Game title styling */
        .game-cart h3 {
            font-size: 1.5rem;
            margin: 10px 0;
            color: #f0db4f; /* Yellowish highlight */
        }

        /* General paragraph styling */
        .game-cart p {
            font-size: 1rem;
            margin: 5px 0;
        }

        /* Release date styling */
        .release-date {
            font-style: italic;
            color: #ccc; 
        }

        /* Platform text styling */
        .platform {
            font-family: 'Doto', sans-serif; 
            color: bisque;
        }

        /* Add button styling */
        .add-button { 
            background: none;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Button image styling */
        .add-button img {
            width: 25px;
            height: 25px;
            transition: transform 0.2s;
        }

        /* Button hover effect */
        .add-button img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <h1>Explore the Central Library</h1>



    <!-- Display success or error messages if present -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'added'): ?>
        <p style="color: green; text-align: center;">Game successfully added to your library!</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'duplicate'): ?>
        <p style="color: red; text-align: center;">This game is already in your library.</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'database'): ?>
        <p style="color: red; text-align: center;">An error occurred while adding the game. Please try again.</p>
    <?php endif; ?>


    <!-- BUTTONS TO GET OUT OF EACH PAGE--> 
    <div style="text-align: center; margin: 20px;">
        <a href="plFront.php" style="color: white; text-decoration: none; margin-right: 10px;">View My Library</a> <br> <br>

    <div class="library-setting">
        <!-- Loop through each game and display it in a card format -->
        <?php foreach ($games as $game): ?>
            <div class="game-cart">
                <!-- Display game cover image (fallback to placeholder if missing) -->
                <img src="<?php echo htmlspecialchars($game['image_url'] ?: 'https://via.placeholder.com/300'); ?>" 
                     alt="<?php echo htmlspecialchars($game['title']); ?>">
                
                <!-- Display game title -->
                <h3><?php echo htmlspecialchars($game['title']); ?></h3>
                
                <!-- Display platform details -->
                <p class="platform">Platform: <?php echo htmlspecialchars($game['platform']); ?></p>
                
                <!-- Display release date -->
                <p class="release-date">Release Date: <em><?php echo htmlspecialchars($game['release_date']); ?></em></p>
                
                <!-- Display game description -->
                <p><?php echo htmlspecialchars($game['description']); ?></p>
             
                <!-- Add to Personal Library Form -->
                <form action="ATPL.php" method="POST">
                    <input type="hidden" name="game_id" value="<?php echo $game['game_id']; ?>">
                    <button type="submit" class="add-button">
                        <img src="https://cbx-prod.b-cdn.net/COLOURBOX35058944.jpg?width=800&height=800&quality=70" 
                             alt="Add to My Shelf">
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
