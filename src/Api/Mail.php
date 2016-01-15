<?php

namespace Dreamhost\Api;

use Dreamhost\Api\MailFilterInterface;

/**
 * The mail API module allows managing email filters.
 *
 * http://wiki.dreamhost.com/API/Mail_commands
 */
class Mail extends ApiResource
{
    /**
     * Dump a list of all e-mail filter rules for all users
     * on all accounts you have access to.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listFilters()
    {
        return parent::runCommand('mail-list_filters');
    }

    /**
     * Adds a new mail filter to an email address
     *
     * @param MailFilterInterface $mailFilter
     * @return Dreamhost\HttpClient\Response
     */
    public static function addFilter(MailFilterInterface $mailFilter)
    {
        return parent::runCommand('mail-add_filter', $mailFilter->toKeyValueArray());
    }

    /**
     * Remove a mail filter from an email address
     *
     * @param  MailFilterInterface $mailFilter
     * @return Dreamhost\HttpClient\Response
     */
    public static function removeFilter(MailFilterInterface $mailFilter)
    {
        return parent::runCommand('mail-remove_filter', $mailFilter->toKeyValueArray());
    }
}
