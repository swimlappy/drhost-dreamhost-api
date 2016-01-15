<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\Account;

echo Account::status()->body();