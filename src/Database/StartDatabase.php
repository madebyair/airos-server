<?php

namespace Server\Database;

use Server\Utils\Logger;

class StartDatabase
{
    public function start(): void {
        Logger::info("Killing old database instance");
        $this->killOldDatabase();
        $password = $this->generateRandomString();

        DatabaseInformation::setPassword($password);

        exec("/usr/server/thread_command 'surreal start file:///usr/server/database -A --auth --user root --pass $password --bind 127.0.0.1:1398'");
    }

    // Credits: https://stackoverflow.com/questions/4356289/php-random-string-generator
    private function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function killOldDatabase(): void {
        exec("kill-port 1398");
    }
}