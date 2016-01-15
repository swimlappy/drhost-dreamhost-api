<?php

namespace Dreamhost\Api;

use Dreamhost\Dreamhost;
use Dreamhost\HttpClient\CurlClient;
use Dreamhost\Exceptions\InvalidMethodRequest;

abstract class ApiResource
{
    private static function buildUrl($command, $params = [])
    {
        $url = rtrim(Dreamhost::apiBaseUrl(), '/') . '?';

        return $url . http_build_query(
            array_replace_recursive([
                'key'       => Dreamhost::apiKey(),
                'unique_id' => uniqid(),
                'cmd'       => $command,
                'format'    => Dreamhost::outputFormat(),
            ],
            (array) $params)
        );
    }

    private static function request($url, $params = [], $type = 'GET', $options = [])
    {
        $ch = CurlClient::instance()->setOptionArray(array_replace_recursive([
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        ], $options));

        return $ch->exec();
    }

    public static function get($url)
    {
        return self::request($url);
    }

    public static function post($url, $params = [])
    {
        return self::request($url, $params, 'POST', [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params)
        ]);
    }

    public static function runCommand($command, $params = [], $type = 'GET')
    {
        $method = strtolower($type);
        return self::{$type}
        (self::buildUrl($command, $params));
    }
}
