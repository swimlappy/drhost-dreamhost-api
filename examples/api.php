<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\ApiMetaCommand;

echo ApiMetaCommand::listKeys()->body();