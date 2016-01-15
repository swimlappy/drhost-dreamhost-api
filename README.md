# A PHP wrapper for Dreamhost API

A simple wrapper for Dreamhost API (Under development).

## Install

```
composer require eduardostuart/dreamhost-php-api
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

## Todo

1. Tests,
2. Announcement List Commands,
3. DreamHost PS Commands,
4. Jabber Commands,
5. MySQL Commands,
6. Rewards Commands
7. Service Control Commands,
8. User Commands

## License

Dreamhost API is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)