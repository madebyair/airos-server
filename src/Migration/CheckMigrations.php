<?php

namespace Server\Migration;

use Server\Utils\Logger;

class CheckMigrations
{
    public static function checkMigrations() : void {
        if(file_exists("/usr/server/migration")) {
            Logger::info("Preparing to migration process.");

            if (filesize("/usr/server/migration") == 0) {
                Logger::info("Migration file is empty, please use API or Server Manager to migrate.");
                MigrationStatus::setStatus("action");
            } else {
                Logger::error("Migration policy is strict, you need to use server migrate command, before starting airos server.");

                exit(1);
            }
        }
    }
}