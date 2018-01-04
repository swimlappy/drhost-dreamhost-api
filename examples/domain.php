<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\Domain;

echo Domain::listDomains()->body();

// echo Domain::listRegistrations()->body();

// echo Domain::registrationAvailable('google.com')->body();

