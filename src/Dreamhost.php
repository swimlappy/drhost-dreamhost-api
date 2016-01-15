<?php

namespace Dreamhost;

use Dreamhost\Exceptions\InvalidOutputFormatException;
use BadMethodCallException;

class Dreamhost
{
    // Dreamhost api key used for requests
    public static $apiKey = null;

    // Output format
    public static $outputFormat = 'json';

    // Api base url
    public static $apiBase = 'https://api.dreamhost.com';

    // Valid output formats
    // More info: http://wiki.dreamhost.com/Application_programming_interface
    public static $validOutputFormats = ['tab','xml','json','perl','php','html','yaml'];

    /**
     * Dreamhost api base url
     * @return String
     */
    public static function apiBaseUrl()
    {
        return self::$apiBase;
    }

    /**
     * The Dreamhost API Key
     * @return String
     */
    public static function apiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API Key used for requests
     * @param String $key
     */
    public static function setApiKey($key)
    {
        self::$apiKey = $key;
    }

    /**
     * The output format
     * @return String
     */
    public static function outputFormat()
    {
        return self::$outputFormat;
    }

    /**
     * Set the output format. Valid formats are:
     * tab (default), xml, json, perl, php,
     * yaml and html
     *
     * @param $format
     */
    public static function setOutputFormat($format)
    {
        if (!self::isValidOutputFormat($format)) {
            throw new InvalidOutputFormatException('Invalid output format');
        }

        self::$outputFormat = $format;
    }

    /**
     * Check if is valid output format
     *
     * @param  String $format
     * @return boolean
     */
    public static function isValidOutputFormat($format)
    {
        return in_array($format, self::$validOutputFormats);
    }

    public static function __callStatic($method,$args=[])
    {
        $className = ucwords($method);

        if( ! class_exists(( $class = "Dreamhost\\Api\\$className")) )
        {
            throw new BadMethodCallException("{$method} not found");
        }

        return new $class;
    }
}
