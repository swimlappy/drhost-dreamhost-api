<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\DNS;

echo DNS::listRecords()->body();

// echo DNS::addRecord('myawesomedomain.xyz','TXT','just-a-test','Super comment')->body();

// echo DNS::removeRecord('myawesomedomain.xyz','TXT','just-a-test')->body();
