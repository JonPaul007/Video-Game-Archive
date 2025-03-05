<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Vault - Register</title>
    <style>
        /* Basic styling for the page */
        body {
            background-color: black; /* Black background for the page */
            color: white; /* White text color for contrast */
            font-family: Arial, sans-serif; /* Use Arial font */
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            align-items: center; /* Center align content */
            justify-content: center; /* Center content vertically */
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
        }

        /* Title styling */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        /* Error message styling */
        h2 {
            font-size: 1.8rem;
            color: red; /* Red color for errors */
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Styling the form */
        form {
            background-color: #1a1a1a; /* Dark gray background for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5); /* Shadow for the form */
            text-align: left; /* Align text to the left */
        }

        /* Label styling */
        label {
            font-size: 1.2rem;
        }

        /* Styling the input fields */
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%; /* Make inputs take full width */
            padding: 10px; /* Add padding for better spacing */
            margin-top: 5px;
            margin-bottom: 15px; /* Add space between inputs */
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px; /* Rounded corners for inputs */
            font-size: 1rem;
        }

        /* Button styling */
        button {
            width: 100%; /* Make the button take full width */
            padding: 10px 20px;
            background-color: #007BFF; /* Blue color for the button */
            color: white;
            border: none;
            border-radius: 5px; /* Rounded button edges */
            font-size: 1.2rem;
            cursor: pointer; /* Change cursor to pointer on hover */
            margin-top: 10px; /* Space between button and input fields */
        }

        /* Button hover effect */
        button:hover {
            background-color: #0056b3; /* Darker blue when hovering */
        }
    </style>
</head>
<body>
    <h1>Welcome to Game Vault</h1>
    <h2>Register to Open the Vault</h2>

    <!-- Display error message if there is an error passed via URL -->
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <!-- Registration form that posts to 'formhandler.php' -->
    <form action="formhandler.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter a username" required minlength="6">

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" placeholder="Enter a password" required minlength="6">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <!-- Submit button -->
        <button type="submit">Register</button>
    </form>
</body>
</html>
