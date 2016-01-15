<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\ApiMeta;

echo ApiMeta::listKeys()->body();