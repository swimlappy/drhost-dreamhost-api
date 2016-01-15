<?php

namespace Dreamhost\HttpClient;

class CurlClient
{
    // CurlClient instance
    private static $instance = null;

    // Curl Headers
    protected $headers = [];

    // Current curl session
    protected $curlHandle = null;

    /**
     * Create a new instance of CurlClient
     *
     * @return Dreamhost\HttpClient\CurlClient
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static;
        }
        return self::$instance;
    }

    /**
     * Intialize curl session
     */
    public function __construct()
    {
        $this->curlHandle = curl_init();
    }

    /**
     * Add new header param
     * @param String $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Set an option on current curl session handle
     *
     * @param String $key
     * @param String $value
     */
    public function setOption($key, $value)
    {
        curl_setopt($this->curlHandle, $key, $value);
        return $this;
    }

    public function setOptionArray($options = [])
    {
        curl_setopt_array($this->curlHandle, (array) $options);
        return $this;
    }

    public function exec()
    {
        if (count($this->headers) > 0) {
            $this->setOption(CURLOPT_HTTPHEADER, $this->headers);
        }

        $body = curl_exec($this->curlHandle);
        $info = curl_getinfo($this->curlHandle);

        return new Response($body, $info);
    }

    public function __destruct()
    {
        curl_close($this->curlHandle);
    }
}
