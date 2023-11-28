<?php

namespace Server\Database;

class DatabaseInformation
{
    private static string $password = "";

    public static function getPassword() : string {
        return self::$password;
    }

    public static function setPassword(string $password) : void {
        self::$password = $password;
    }
}