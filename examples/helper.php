<?php

require __DIR__ . '/../vendor/autoload.php';

use Dreamhost\Dreamhost;

(new Dotenv\Dotenv(dirname(__DIR__)))->load();

Dreamhost::setOutputFormat(getenv('DREAMHOST_OUTPUT'));
Dreamhost::setApiKey(getenv('DREAMHOST_KEY'));
