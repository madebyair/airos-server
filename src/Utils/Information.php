<?php

namespace Server\Utils;

use Server\Migration\MigrationStatus;

class Information
{
    public function index() : array {
        return [
            "object" => "info",
            "data" => [
                "version" => Version::$version,
                "channel" => Version::$channel,
                "migration_status" => MigrationStatus::getStatus()
            ]
        ];
    }
}