<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Body styling: background color, text color, font, and centering */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* Header styling */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        /* Subheader styling */
        h2 {
            font-size: 1.8rem;
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form styling: background color, padding, border radius, and shadow */
        form {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            text-align: left;
        }

        /* Label styling */
        label {
            font-size: 1.2rem;
        }

        /* Input fields styling */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* Button styling: background color, padding, text styling, and hover effect */
        button {
            width: 100%;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Hover effect on button */
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Main heading of the page -->
    <h1>Welcome Back!</h1>
    <!-- Subheading prompting the user to log in -->
    <h2>Log in to access the biggest online video game archive</h2>
    
    <!-- Form for user login -->
    <form action="loginHandler.php" method="POST">
        <!-- Username input field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <!-- Password input field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <!-- Submit button -->
        <button type="submit">Login</button>
    </form>
</body>
</html>
