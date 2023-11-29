<?php

namespace Server\Loaders;

use Server\Database\Database;
use Server\Migration\MigrationStatus;
use Server\Utils\Logger;

class UserLoader
{
    public static function load() {
        $query = Database::query("SELECT * FROM users");

        if (count($query) == 0) {
            Logger::info("No users found, entering setup mode.");
        }

        if (MigrationStatus::getStatus() == "action" && count($query) >= 1) {
            Logger::error("Users in database exists, but /usr/server/migration exists");

            exit(1);
        }

        return $query;
    }
}