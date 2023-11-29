<?php

namespace Server;

use Server\Database\Database;
use Server\Database\StartDatabase;
use Server\Loaders\UserLoader;
use Server\Migration\CheckMigrations;
use Server\Migration\ScanServices;
use Server\Utils\Logger;

use React\Http\HttpServer;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Socket\SocketServer;

class Server
{
    private HttpServer $server;
    private SocketServer $socket;

    private array $users = [];

    private array $services = [];

    public function start() : void {
        Logger::info("Starting new airos server instance.");

        CheckMigrations::checkMigrations();
        (new StartDatabase())->start();

        sleep(1);
        Database::query("INFO for database;");
        $this->loadUsers();

        $this->services = ScanServices::scanServices();

        $this->server = new HttpServer(function (ServerRequestInterface $request) {
            return Response::json(Router::route($request->getUri()->getPath(), $request->getMethod(), $request));
        });

        $this->socket = new SocketServer('127.0.0.1:7069');
        $this->server->listen($this->socket);

        Logger::info("Socket online at 127.0.0.1:7069");
    }

    private function loadUsers() : void {
        $this->users = UserLoader::load();
    }
}