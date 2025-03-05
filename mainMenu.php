<!DOCTYPE html>
<html lang="en">

<!-- Navigation Bar -->
<nav>
    <!-- Unordered list for menu items, styled to be inline and spaced out -->
    <ul style="list-style: none; display: flex; gap: 20px; justify-content: center;">
        <!-- Each list item is a link to different pages -->
        <li><a href="centralLibrary.php">Explore Library</a></li>
        <li><a href="plFront.php">My Collection</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</nav>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Vault</title>
    <style>
        /* Body styling for centering the content */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            flex-direction: column;
        }

        /* Main heading styling */
        h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Paragraph styling */
        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Search container for spacing and positioning */
        .search-container {
            margin-top: 20px;
        }

        /* Text input styling for search field */
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Button styling: background color, padding, border, and hover effect */
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        /* Hover effect for the search button */
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Main heading for the welcome message -->
    <h1>Welcome to the Game Vault</h1>

    <!-- Search form for looking up games by name -->
    <form action="searchResults.php" method="GET" style="text-align: center; margin: 20px;">
        <!-- Input field for the game search -->
        <input type="text" name="query" placeholder="Enter game name..." style="padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px;">
        
        <!-- Submit button for initiating the search -->
        <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Search
        </button>
    </form>
</body>

</html>
