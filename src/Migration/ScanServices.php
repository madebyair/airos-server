<?php

namespace Server\Migration;

use Server\Services\SupportedServices;
use Server\Utils\Logger;

class ScanServices
{
    public static function scanServices() : array {
        $result = shell_exec("systemctl --type=service");

        $lines = explode(PHP_EOL, $result);

        $supported = SupportedServices::$supported;

        $services = [];

        foreach ($lines as $line) {
            if ($line !== "  UNIT                                                                                      LOAD   ACTIVE SUB     DESCRIPTION") {
                $exploded = explode(" ", $line);

                foreach ($exploded as $key) {
                    if ($key !== "") {
                        if (str_ends_with($key, ".service")) {
                            $service = str_replace(".service", "", $key);

                            if (in_array($service, $supported)) {
                                Logger::info("Found service: $service");
                                $services[] = $service;
                            }
                        }
                    }
                }
            }
        }

        return $services;
    }
}