<?php

namespace Dreamhost\Api;

use Dreamhost\Exceptions\InvalidDNSDomainException;
use Dreamhost\Exceptions\InvalidDNSRecordType;

/**
 * The dns API module allows you to manage Domain Name Service records.
 *
 * http://wiki.dreamhost.com/API/Dns_commands
 */
class DNS extends ApiResource
{
    // Valid Record types (Dreamhost list)
    protected static $validTypes = [
        'A','CNAME','NS','PTR','NAPTR','SRV','TXT','SPF','AAAA'
    ];

    /**
     * Dump a list of all dns records for all domains (not including registrations)
     * on all accounts you have access to.
     * Skips the dreamhosters.com, dreamhost.com, dreamhostps.com, and newdream.net zones.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listRecords()
    {
        return parent::runCommand('dns-list_records');
    }

    /**
     * Adds a new dns record to a domain
     * Keep in mind dns changes may take a while to propagate.
     * You cannot add dreamhosters.com records.
     *
     * @param  String $domain
     * @param  String $type
     * @param  String $value
     * @param  String|null $comment
     * @return Dreamhost\HttpClient\Response
     */
    public static function addRecord($domain, $type, $value, $comment = null)
    {
        if (self::isDreamhostersUrl($domain)) {
            throw new InvalidDNSDomainException('You cannot add dreamhosters.com records');
        }

        if (!self::isValidType($type)) {
            throw new InvalidDNSRecordType("{$type} is not a valid DNS type");
        }

        return parent::runCommand('dns-add_record', [
            'record'  => $domain,
            'type'    => $type,
            'value'   => $value,
            'comment' => $comment
        ]);
    }

    /**
     * Removes an existing editable dns record
     * Keep in mind dns changes may take a while to propagate.
     * You cannot remove dreamhosters.com records.
     *
     * @param  String $domain
     * @param  String $type
     * @param  String $value
     * @return Dreamhost\HttpClient\Response
     */
    public static function removeRecord($domain, $type, $value)
    {
        if (self::isDreamhostersUrl($domain)) {
            throw new InvalidDNSDomainException('You cannot add dreamhosters.com records');
        }

        if (!self::isValidType($type)) {
            throw new InvalidDNSRecordType("{$type} is not a valid DNS type");
        }

        return parent::runCommand('dns-remove_record', [
            'record'  => $domain,
            'type'    => $type,
            'value'   => $value,
        ]);
    }

    /**
     * Check if is a dreamhosters.com url
     *
     * @param  String  $url
     * @return boolean
     */
    public static function isDreamhostersUrl($url)
    {
        if (preg_match('/^http/i', $url)) {
            $urlInfo = parse_url($url);
            $url = $urlInfo['host'];
        }

        return (bool) preg_match('/dreamhosters\.com/i', $url);
    }

    /**
     * Check if is a valid record type
     *
     * @param  String  $type
     * @return boolean
     */
    public static function isValidType($type)
    {
        return in_array($type, self::$validTypes);
    }
}
