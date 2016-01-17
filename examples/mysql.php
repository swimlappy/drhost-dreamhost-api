<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\MySQL;

echo MySQL::listDatabases()->body();

// echo MySQL::listHostnames()->body();

// echo MySQL::addHostname('mysql.mydomain.xyz');

// echo MySQL::removeHostname('mysql.mydomain.xyz');

// echo MySQL::listUsers();

// echo MySQL::addUser('mydatabase','myuniqueuser','h4rdP4ss0wordYe4h');

// echo MySQL::removeUser('mydatabase','myuniqueuser');