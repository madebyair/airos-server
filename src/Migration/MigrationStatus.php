<?php

namespace Server\Migration;

class MigrationStatus
{
    private static $status = "migrated";

    public static function getStatus() : string { return static::$status; }

    public static function setStatus(string $status) : void { static::$status = $status; }
}