<?php

namespace Server\Database;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Server\Utils\Logger;

class Database
{
    public static function query(string $query) : array {
        $client = new Client();
        try {
            $res = $client->request('POST', "http://127.0.0.1:1398/sql", [
                'headers' => [
                    'Accept' => 'application/json',
                    "Authorization" => "Basic " . base64_encode("root:" . trim(DatabaseInformation::getPassword())),
                    'NS' => "server",
                    'DB' => "server"
                ],
                'body' => $query,
            ]);

            $json = json_decode($res->getBody()->getContents(), true);

            return $json[0]["result"];
        } catch (GuzzleException $e) {
            Logger::error("Failed to connect to database: ". $e->getMessage());

            exit(1);
        }
    }
}