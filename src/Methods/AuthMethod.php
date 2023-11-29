<?php

namespace Server\Methods;

use Server\Utils\Logger;

class AuthMethod
{
    public function login($request) : array {
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams["user"]) || !isset($queryParams["pass"])) {
            return ["error" => "Bad request"];
        }

        Logger::info("Created new session for user ". $queryParams["user"]);
    }
}