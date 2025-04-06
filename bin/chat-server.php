<?php
date_default_timezone_set('Asia/Manila');

require_once __DIR__ . '/../vendor/autoload.php'; // Adjust the path to your autoload.php if needed

require dirname(__DIR__) . '/dbConnection/ClsConnection.php';

use MyApp\Chat;

$chat = new Chat();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderID = $_POST['senderUserID'];
    $receiverID = $_POST['receiverUserID'];
    $message = $_POST['message'];

    $chat->sendMessage($senderID, $receiverID, $message);

    echo json_encode(["status" => "Message sent"]);
}
