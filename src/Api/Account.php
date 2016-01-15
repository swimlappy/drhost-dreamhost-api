<?php

namespace Dreamhost\Api;

/**
 * The account API module contains commands for
 * checking status or usage of your account.
 *
 * Account API Commands info:
 * http://wiki.dreamhost.com/API/Account_commands
 */
class Account extends ApiResource
{
    /**
     * Lists bandwidth usage for all visible domain services.
     * Bandwidth usage is in bytes since the beginning of the current billing cycle
     * (which can be determined using account-status).
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function domainUsage()
    {
        return parent::runCommand('account-domain_usage');
    }

    /**
     * Lists all SSH public keys on this account.
     * SSH keys may be used to provide root access to any of your VPS or Dedicated Servers
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listKeys()
    {
        return parent::runCommand('account-list_keys');
    }

    /**
     * Returns the status of the current account.
     * All results of this function should be treated as advisory only.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function status()
    {
        return parent::runCommand('account-status');
    }

    /**
     * Lists disk and bandwidth usage for all visible users.
     * Disk usage is in kilobytes; bandwidth usage is in bytes since the start of the billing cycle.
     * In most cases, bandwidth usage will appear as zero here.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function userUsage()
    {
        return parent::runCommand('account-user_usage');
    }
}
