# About

Dr.Host is a simple wrapper for [Dreamhost API](http://wiki.dreamy.com/API). (Under development)

## Install

```
composer require eduardostuart/drhost-dreamhost-api
```

## Usage

```php
use Dreamhost\Dreamhost;

Dreamhost::setOutputFormat('json'); // default format: json
Dreamhost::setApiKey('MYAPIKEY');
```

### Account

**Domain Usage**

```php
echo \Dreamhost\Api\Account::domainUsage();
```
**List of All SSH Keys**

```php
echo \Dreamhost\Api\Account::listKeys();
```
**Status of the current account**

```php
echo \Dreamhost\Api\Account::status();
```
**Disk Usage and bandwith of the current account**

```php
echo \Dreamhost\Api\Account::userUsage();
```

### API Meta Commands

**List all commands this api key can run**

```php
echo \Dreamhost\Api\ApiMetaCommand::listAccessibleCmds();
```

**List all api keys**

```php
echo \Dreamhost\Api\ApiMetaCommand::listKeys();
```

### DNS

**List of all dns records for all domains**

```php
echo \Dreamhost\Api\DNS::listRecords();
```

**Create a new dns record for a specific domain**
*You cannot add dreamhosters.com records.*

```php
echo \Dreamhost\Api\DNS::addRecord($domain,$type,$value,$comment = null);
```

**Removes an existing editable dns record**
*You cannot add dreamhosters.com records.*

```php
echo \Dreamhost\Api\DNS::removeRecord($domain,$type,$value)
```

### Mail

**List of all e-mail filter rules for all users**

```php
echo \Dreamhost\Api\Mail::listFilters();
```

**Adds a new mail filter to an email address**

```php
echo \Dreamhost\Api\Mail::addFilter(MailFilterInterface $mailFilter);
```

**Remove a mail filter from an email**

```php
echo \Dreamhost\Api\Mail::removeFilter(MailFilterInterface $mailFilter);
```

#### MailFilter

**MailFilter example:**

```php
$filter = MailFilter::make()
    ->address('contato@eduardostuart.com.br')
    ->filterOn('subject')
    ->filter('viagra')
    ->action('delete')
    ->contains(true)
    ->rank(0)
    ->stop(1);

echo \Dreamhost\Api\Mail::addFilter($filter);
```

### MySQL

**List of all active MySQL Databases**

```php
echo \Dreamhost\Api\MySQL::listDatabases();
```

**List of all MySQL Hostnames**

```php
echo \Dreamhost\Api\MySQL::listHostnames();
```

**Add a MySQL Hostname**

```php
echo \Dreamhost\Api\MySQL::addHostname('mysql.mydomain.xyz');
```

**Remove a MySQL Hostname**

```php
echo \Dreamhost\Api\MySQL::removeHostname('mysql.mydomain.xyz');
```

**List of all users and their privileges**

```php
echo \Dreamhost\Api\MySQL::listUsers();
```

## Alternative way to run commands

```php
echo \Dreamhost::account()->status();
echo \Dreamhost::mysql()->listDatabases();
echo \Dreamhost::dns()->listRecords();
...
```

## Todo

1. Announcement List Commands,
1. DreamHost PS Commands,
1. Jabber Commands,
1. MySQL Commands (add and remove users),
1. Rewards Commands
1. Service Control Commands,
1. User Commands


## License

Dr.Host is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
