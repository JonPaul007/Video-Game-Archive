<?php
// Start the session to access session variables
session_start();


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

// Create PDO connection
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    error_log($e->getMessage());  // Log the error
    die("<div style='color: red; text-align: center;'>Unable to connect to the database. Please try again later.</div>");
}

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginPage.php");
    exit;
}

// Get the user ID from the session variable
$user_id = $_SESSION['user_id'];

try {
    // Prepare the SQL query to fetch games from the personal library of the logged-in user
    $stmt = $pdo->prepare("
        SELECT g.game_id, g.title, g.platform, g.publisher, g.image_url
        FROM personal_library pers
        JOIN games g ON pers.game_id = g.game_id
        WHERE pers.user_id = ?
    ");
    // Execute the query and get the user's games
    $stmt->execute([$user_id]);
    $games = $stmt->fetchAll();
} catch (PDOException $e) {
    // Log error and show a message if there's an issue fetching games from the database
    error_log($e->getMessage());
    die("<div style='color: red; text-align: center;'>Error fetching personal library games. Please try again later.</div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=TT+Rounds+Neue:wght@400;700&display=swap" rel="stylesheet">
    <title>My Game Shelf</title>
    
    <!-- Navigation buttons for central library and main menu -->
    <div style="text-align: center; margin: 20px;">
        <a href="centralLibrary.php" style="text-decoration: none;">
            <button style="background-color: #007BFF; color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; font-size: 1rem; margin-right: 10px;">
                Go to Central Library
            </button>
        </a>
        <a href="mainMenu.php" style="text-decoration: none;">
            <button style="background-color: #28a745; color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; font-size: 1rem;">
                Return to Main Menu
            </button>
        </a>
    </div>

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
        }

        /* Library layout */
        .library-setting {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* Game card styling */
        .game-card {
            border: 1px solid white;
            border-radius: 10px;
            padding: 10px;
            width: 300px;
            background-color: #1a1a1a;
            text-align: center;
        }

        .game-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .game-card h3 {
            margin: 10px 0;
            font-family: 'TT Rounds Neue', sans-serif; 
            font-size: 1.5rem;
            color: white;
        }

        .game-card button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .game-card button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <!-- Title of the page -->
    <h1>My Game Shelf</h1>

    <div class="library-setting">
        <?php if (empty($games)): ?>
            <!-- Message displayed if the user has no games in their library -->
            <p style="text-align: center;">Your library is empty...Go to the central library to build your collection!</p>
        <?php else: ?>
            <!-- Loop through each game in the library and display it -->
            <?php foreach ($games as $game): ?> 
                <div class="game-card">
                    <!-- Display game image, using a placeholder if no image is available -->
                    <img src="<?php echo htmlspecialchars($game['image_url'] ?: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png'); ?>" alt="<?php echo htmlspecialchars($game['title']); ?>">
                    
                    <!-- Display the game's title, platform, and publisher -->
                    <h3><?php echo htmlspecialchars($game['title']); ?></h3>
                    <p><strong>Platform:</strong> <?php echo htmlspecialchars($game['platform']); ?></p>
                    <p><strong>Publisher:</strong> <?php echo htmlspecialchars($game['publisher']); ?></p>

                    <!-- Delete Button to remove the game from the personal library -->
                    <form action="deleteFromLibrary.php" method="POST">
                        <input type="hidden" name="game_id" value="<?php echo $game['game_id']; ?>">
                        <button type="submit">Remove From Shelf</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
