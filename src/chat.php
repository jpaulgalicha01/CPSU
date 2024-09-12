<?php

namespace MyApp;

use DateTime;
use db;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


class Chat implements MessageComponentInterface {
    protected $clients;
    protected $userConnections;
    protected $pdo;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->userConnections = [];

        $connection = new db();
        $this->pdo = $connection->PlsConnect();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $this->userConnections[$conn->resourceId] = $conn;

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $data = json_decode($msg, true);
        if (isset($data['senderUserID']) && isset($data['receiverUserID'])) {
            $receiverUserID = $data['receiverUserID'];
            $senderUserID = $data['senderUserID'];
            $message = $data['message'];

            $Date =  new DateTime();
            $DateConverted = $Date->format('m-d-Y g:i a');

            $insertingdata = $this->pdo->prepare("INSERT INTO `tblmessages`(`UserID`, `receiver_id`, `message`) VALUES (?,?,?)");
            $insertingdata->execute([$senderUserID,$receiverUserID,$message]);

            foreach ($this->clients as $client) {
                // if ($client !== $from && isset($this->userConnections[$client->resourceId])) 
                // {
                    // Check if the connection is the receiver
                    $client->send(json_encode([
                        'senderUserID' => $senderUserID,
                        'receiverUserID' => $receiverUserID,
                        'message' => $message,
                        'date' =>$DateConverted
                    ]));
                // }
            }
        }else{
            echo"asdd";
        }

        
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}