<?php

namespace MyApp;

use DateTime;
use db;
use Pusher\Pusher;


class Chat
{
    protected $pdo;
    protected $pusher;

    public function __construct()
    {
        $connection = new db();
        $this->pdo = $connection->PlsConnect();

        // Initialize Pusher
        $this->pusher = new Pusher(
            "34fb7ca0523a79360d6f",
            "baf073697642d19447af",
            "1968400",
            ['cluster' => 'ap1', 'useTLS' => true]
        );
    }

    public function sendMessage($senderUserID, $receiverUserID, $message)
    {
        $Date = new DateTime();
        $DateConverted = $Date->format('m-d-Y g:i a');

        // Insert into database
        $insertingdata = $this->pdo->prepare("INSERT INTO `tblmessages`(`UserID`, `receiver_id`, `message`) VALUES (?, ?, ?)");
        $insertingdata->execute([$senderUserID, $receiverUserID, $message]);

        // Broadcast message via Pusher
        $this->pusher->trigger("chat", "new_message", [
            'senderUserID' => $senderUserID,
            'receiverUserID' => $receiverUserID,
            'message' => $message,
            'date' => $DateConverted
        ]);
    }
}
