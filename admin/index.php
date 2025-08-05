<?php
session_start();

// Placeholder for checking login credentials
function authenticate($userbot, $password) {
    // Read the contents of the password file
    $filename = "password.txt";
    $fileContents = file_get_contents($filename);

    // Split the file content into userbot and password
    list($storedUserbot, $storedPassword) = explode("|", $fileContents);

    // Check if the provided Userbot and password match the stored values
    return ($userbot === $storedUserbot && $password === $storedPassword);
}

// Placeholder for updating password
function updatePassword($newPassword) {
    $filename = "password.txt";
    
    // Write the new password to the file
    if (file_put_contents($filename, "CHEIF|$newPassword") !== false) {
        // Password updated successfully
        return true;
    } else {
        // Error writing to the file
        return false;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is already logged in
    if (isset($_SESSION['userbot'])) {
        if(isset($_POST['new_password'])) {
            $newPassword = $_POST['new_password'];
            if(updatePassword($newPassword)) {
                header("Location: botpanel.php");
                exit();
            } else {
                // Error updating password
                $passwordChangeError = "Error updating password!";
            }
        } else {
            header("Location: botpanel.php");
            exit();
        }
    } else {
        $userbot = $_POST['userbot'];
        $password = $_POST['password'];

        // Placeholder: Authenticate user
        if (authenticate($userbot, $password)) {
            // Store userbot in session
            $_SESSION['userbot'] = $userbot;
        } else {
            $loginError = "Invalid userbot or password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEIF BOT LOGIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0a0a0a;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            width: 70%;
            border: 1px solid #fff;
            background-color: #e6c200;
            color: black;
            padding: 20px;
            margin: 60px auto 40px; 
            border-radius: 5px;
            box-shadow: 0 0 0px #4CAF50;
            animation: neon 2s ease-in-out infinite alternate;
        }
        @keyframes neon {
            from {
                box-shadow: 0 0 0px #e6c200, 0 0 1px #e6c200, 0 0 2px #e6c200, 0 0 3px #e6c200, 0 0 4px #e6c200, 0 0 5px #e6c200, 0 0 6px #e6c200, 0 0 7px #e6c200;
            }
            to {
                box-shadow: 0 0 1px #e6c200, 0 0 2px #e6c200, 0 0 3px #e6c200, 0 0 4px #e6c200, 0 0 5px #e6c200, 0 0 6px #e6c200, 0 0 7px #e6c200, 0 0 8px #e6c200;
            }
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-left: 18px;
            margin-bottom: 3px;
            text-align: left;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            width: 80%;
            margin: 10px 10px;
            border: 2px solid #fff;
            border-radius: 5px;
            background-color: white;
            outline: none;
            font-family: Arial, sans-serif;
        }
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #000;
            border-radius: 10px;
            margin: 10px 10px;
            height: 100%;
            width: 80%;
            background: #2980b9;
            color: black;
            outline: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #1c6b91;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            color: #ff0000;
        }
        .change-later {
         display: inline-block;
         padding: 10px 20px;
         margin-top: 10px;
         background-color: #2980b9;
         color: #fff;
         text-decoration: none;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
}

        .change-later:hover {
        background-color: #2c3e50;
}   
    header {
    text-align: center;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0); /* Adjust the alpha (last) value for transparency */
    color: #fff; /* Text color */
    margin: 80px auto 60px; /* Adjusted margin values */
    font-size: 14px;
    font-weight: 800; /* Make the font bold */
    letter-spacing: 5px;
    width: 100%;
    box-sizing: border-box;
    position: fixed;
    height: 50px;
    z-index: 1000;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
</head>
<body>
    <header>
        <h2>CHEIF PHISHING WEB</h2> <!-- Branding name added here -->
    </header>
    <div class="container">
        <?php if(isset($loginError)) { ?>
            <div classmessage"><?php echo $loginError; ?></div>
        <?php } ?>
        <?php if(isset($_SESSION['userbot'])) { ?>
            <?php if(isset($_POST['new_password'])) { ?>
                <?php if(isset($passwordChangeError)) { ?>
                    <div class="message"><?php echo $passwordChangeError; ?></div>
                <?php } else { ?>
                    <div class="message">Password changed successfully!</div>
                <?php } ?>
            <?php } ?>
            <h2>Change Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <input type="submit" value="Change Password">
            </form>
            <br>
            <a href="botpanel.php" class="change-later">Change Later</a>
        <?php } else { ?>
            <h2>Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="username">Username:</label>
                <input type="text" id="userbot" name="userbot" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
        <?php } ?>
    </div>
</body>
</html>