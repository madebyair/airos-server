<?php

namespace Server;

use Server\Utils\Logger;

use React\Http\HttpServer;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Socket\SocketServer;

class Server
{
    private HttpServer $server;
    private SocketServer $socket;
    public function start() : void {
        Logger::info("Starting new airos server instance.");

        $this->server = new HttpServer(function (ServerRequestInterface $request) {
            return Response::json([
                "object" => "info"
            ]);
        });

        $this->socket = new SocketServer('127.0.0.1:7069');
        $this->server->listen($this->socket);

        Logger::info("Socket online at 127.0.0.1:7069");
    }
}