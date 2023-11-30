<?php

namespace Server\Session;

use Ramsey\Uuid\Uuid;

class SessionManager
{
    private static array $sessions;

    /**
     * @return array
     */
    public static function getSessions(): array
    {
        return self::$sessions;
    }

    public static function getSession(string $uuid) : Session {
        $return = false;

        foreach (self::$sessions as $session) {
            if ($session->getUuid() == $uuid) {
                $return = $session;
            }
        }

        return $return;
    }

    public static function createSession(string $modelId, string $firstName, string $lastName, string $email, string $password) : string {
        $uuid = Uuid::uuid7()->toString();

        self::$sessions[] = new Session($uuid, $modelId, $firstName, $lastName, $email, $password);

        return $uuid;
    }

    public static function deleteSession(string $uuid) : void {
        foreach (self::$sessions as $key) {
            if ($key->getUuid() == $uuid) {
                unset(self::$sessions[$key]);
                break;
            }
        }
    }
}