<?php

require __DIR__ . '/helper.php';

use Dreamhost\Api\Mail;
use Dreamhost\Api\MailFilter;

echo Mail::listFilters();

// $filter = MailFilter::make()
//     ->address('contato@eduardostuart.com.br')
//     ->filterOn('subject')
//     ->filter('viagra')
//     ->action('delete')
//     ->contains(true)
//     ->rank(0)
//     ->stop(1);

// echo Mail::addFilter($filter);
// echo Mail::removeFilter($filter);