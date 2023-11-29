<?php

namespace Server\Database;

use Server\Utils\Logger;

class StartDatabase
{
    public function start(): void {
        Logger::info("Killing old database instance");
        $this->killOldDatabase();
        $password = $this->loadPassword();

        DatabaseInformation::setPassword($password);

        exec("/usr/server/thread_command 'surreal start -b 127.0.0.1:1398 file:///usr/server/database -A --auth --user root --pass $password'");
    }


    private function killOldDatabase(): void {
        shell_exec("/usr/server/kill 1398");
    }

    private function loadPassword(): string {
        if(!file_exists("/usr/server/pass")) {
            Logger::error("Database password (/usr/server/pass) are empty. Please put new database password, to continue.");
            exit(1);
        }

        if (filesize("/usr/server/pass") == 0) {
            Logger::error("Database password (/usr/server/pass) are empty. Please put new database password, to continue.");
            exit(1);
        } else {
            $file = fopen("/usr/server/pass", "r");
            $content = fread($file, filesize("/usr/server/pass"));
            fclose($file);

            return $content;
        }
    }
}