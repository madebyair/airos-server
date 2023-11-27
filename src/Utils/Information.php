<?php

namespace Server\Utils;

class Information
{
    public function index() : array {
        return [
            "object" => "info",
            "data" => [
                "version" => Version::$version,
                "channel" => Version::$channel
            ]
        ];
    }
}