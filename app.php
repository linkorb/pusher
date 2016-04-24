<?php


require_once __DIR__ . '/vendor/autoload.php';

// Setup the 'scope' that holds all shared variables
$scope = new Pusher\Scope();

// Setup a single eventloop for both servers
$loop = React\EventLoop\Factory::create();

// Setup the http/api server using plain reactphp
// Passing the scope to the server instance
$httpSocket = new React\Socket\Server($loop);
$httpServer = new React\Http\Server($httpSocket);
$apiServer = new Pusher\ApiServer($scope, $httpServer);

// Setup the websocket, using same eventloop and scope
$webSocket = new React\Socket\Server($loop);

$socketServer = new Pusher\SocketServer($scope);

$wsServer = new Ratchet\WebSocket\WsServer($socketServer);
$httpServer = new Ratchet\Http\HttpServer($wsServer);
$io = new Ratchet\Server\IoServer($httpServer, $webSocket, $loop);

echo "YO\n";
$httpSocket->listen(8080);
$webSocket->listen(8081);
echo "RUN:\n";
$loop->run();
