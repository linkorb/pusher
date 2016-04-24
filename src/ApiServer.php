<?php

namespace Pusher;

class ApiServer
{
    private $scope;
    public function __construct(Scope $scope, $http)
    {
        $this->scope = $scope;
        $http->on('request', function ($request, $response) {
            return $this->handleRequest($request, $response);
        });
    }
    
    private function handleRequest($request, $response)
    {
        $i = $this->scope->increaseRequestCount();

        $text = "This is request number $i.<br />\n";
        $text .= "Clients: " . count($this->scope->getClients());
        $headers = array('Content-Type' => 'text/html');

        $response->writeHead(200, $headers);
        $response->end($text);
    }
}
