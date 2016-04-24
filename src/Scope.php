<?php

namespace Pusher;

class Scope
{
    private $clients = [];
    
    public function addClient($client)
    {
        $this->clients[] = $client;
    }
    public function getClients()
    {
        return $this->clients;
    }
    
    private $requestCount = 0;
    
    public function increaseRequestCount()
    {
        $this->requestCount++;
        return $this->requestCount;
    }
}
