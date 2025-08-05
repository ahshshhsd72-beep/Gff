<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userbot'])) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}
// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: index.php");
    exit();
}

// Function to get the bot username using the Telegram API
function getBotUsername($botToken) {
    $url = "https://api.telegram.org/bot{$botToken}/getMe";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return ($data && $data['ok']) ? $data['result']['username'] : false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEIF BOT PANEL</title>
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
            width: 80%;
            border: 1px solid #fff;
            background-color: #e6c200;
            color: black;
            padding: 20px;
            margin: 10px auto 10px; 
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

        #current_chat_id, #current_bot_token {
            margin-top: 5px;
            padding: 10px;
            background-color: #fff000;
            border: 3px solid #000;
            border-radius: 5px;
            display: inline-block;
        }

        #current_chat_id {
            color: #000;
            margin-left: px;
        }

        #current_bot_token {
            color: #000;
            font-size: 10px;
            font-weight: 800;
        }
        input[type="number"] {
            padding: 10px;
            width: 90%;
            margin: 10px 0px;
            border: 2px solid #fff;
            border-radius: 5px;
            background-color: white;
            font-color: white;
            outline: display;
        }
        input[type="text"] {
            padding: 5px;
            width: 100%;
            margin: 15px 0px;
            border: 2px solid #fff;
            border-radius: 5px;
            background-color: white;
            font-color: white;
            outline: display;
        }
        button[type="submit"] {
            padding: 10px;
            border: 1px solid #000;
            border-radius: 10px;
            margin: 10px 10px;
            height: 100%;
            width: 80%;
            background: #2980b9;
            color: black;
            outline: 1px;
            font-size: 100%;
        }
        label {
            display: block;
            margin-left: 0px;
            margin-top: 0px;
            text-align: left;
        }
        input[type="submit"][name="logout"] {
    background: #2980b9;
    color: black;
}

    input[type="submit"][name="logout"]:hover {
    background-color: #1c6b91;
}
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .updated {
            color: blue;
        }
    header {
    text-align: center;
    padding: 10px;
    background-color: rgba(255, 255, 255, 0); 
    color: #fff; 
    margin: 30px auto 40px; 
    font-size: 14px;
    font-weight: 800; 
    letter-spacing: 7px;
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
    <h1>Welcome, <?php echo $_SESSION['userbot']; ?>!</h1>
    <form method="post">
    <div class="container">
        <div id="current_chat_id">
            <?php
            $currentChatId = file_get_contents('chatid.txt');
            if (!empty($currentChatId)) {
                echo "Current Chat ID: \n\n" . $currentChatId;
            } else {
                echo "No Chat ID available";
            }
            ?>
        
        </div>
            <br>
        </div>
        <div class="container">
        <div id="bot_username"></div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['chat_id'])){
                $chatId = $_POST['chat_id'];
                file_put_contents('chatid.txt', $chatId);
            } else {
                echo "<div class='error'>Chat ID not provided!</div>";
            }
        }
        ?>
        <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="chat_id">Enter Your Chat ID:</label>
            <input type="number" id="chat_id" name="chat_id" value="<?php echo $currentChatId; ?>"><br>    
            <button type="submit">Submit</button>
            </div>
            <button type="submit" name="logout" value="Logout">logout</button>
        </form>
    </div>
</body>
</html>