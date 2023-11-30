<?php

namespace Server\Methods;

use Server\Utils\Logger;
use Server\Session\SessionManager;
use Server\Database\Database;

class AuthMethod
{
    public function login($request) : array {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams["user"]) || !isset($queryParams["pass"])) {
            return ["error" => "Bad request"];
        }

        $user = false;

        $query = Database::query("SELECT * FROM users WHERE username = '" . $queryParams["user"] ."'");

        if (count($query) !== 0) {
            $user = $query[0];
        } else {
            $query = Database::query("SELECT * FROM users WHERE email = '" . $queryParams["user"] ."'");
            if (count($query)!== 0) {
                $user = $query[0];
            }
        }

        if (!$user) {
            return ["status" => "failed"];
        }

        if (!password_verify($queryParams["pass"], $user["password"])) {
            return ["status" => "failed"];
        }

        $id = explode(":", $user["id"]);

        $session = SessionManager::createSession($id[1], $user["firstName"], $user["lastName"], $user["email"], $user["password"]);

        Logger::info("Created new session for user ". $queryParams["user"]);

        return [
            "status" => "success",
            "session" => $session
        ];
    }
}