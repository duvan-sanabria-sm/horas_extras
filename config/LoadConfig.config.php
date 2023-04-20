<?php

class LoadConfig
{
    private static $path;
    public static function getConfig()
    {
        self::$path = realpath($_SERVER["DOCUMENT_ROOT"] . '/config/config.json');
        if (file_exists(self::$path)) {
            $json_data = file_get_contents(self::$path);
            return json_decode($json_data);
        } else {
            return 'No hay archivo';
        }
    }
}
