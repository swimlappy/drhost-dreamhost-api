<?php

namespace Dreamhost\HttpClient;

class Response
{
    private $body;

    private $requestInfo;

    public function __construct($body, $requestInfo)
    {
        $this->body = $body;
        $this->requestInfo = $requestInfo;
    }

    public function body()
    {
        return $this->body;
    }

    public function httpCode()
    {
        return $this->requestInfo['http_code'];
    }

    public function httpInfo()
    {
        return $this->requestInfo;
    }

    public function __toString()
    {
        return $this->body;
    }
}
