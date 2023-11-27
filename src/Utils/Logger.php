<?php
namespace Server\Utils;

class Logger
{
    public static function info(string $str) : void {
        echo "\033[36m INFO \033[0m $str \n";
    }

    public static function error(string $str) : void {
        echo "\033[91m ERROR \033[0m $str \n";
    }
}
