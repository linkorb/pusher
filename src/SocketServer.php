<?php

namespace Pusher;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketServer implements MessageComponentInterface
{
    private $scope;
    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }
    public function onOpen(ConnectionInterface $conn)
    {
        $this->scope->addClient($conn);
        
        foreach ($this->scope->getClients() as $client) {
            $conn->send("New connection!");
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
