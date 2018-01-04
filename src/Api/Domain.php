<?php

namespace Dreamhost\Api;

use Dreamhost\Exceptions\InvalidDomainTLDException;
use Dreamhost\Exceptions\InvalidDomainNameException;

/**
 * The domain API module allows you to manage Domain records.
 *
 * http://wiki.dreamhost.com/API/Domain_commands
 */
class Domain extends ApiResource
{
    // Valid Top Level Domains
    protected static $validTLDS = [                                                                                                                                                    
        'com','org','net','info'
    ];

    /**
     * Dump a list of all hosted domains (not included registrations)
     * on all accounts you have access to.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listDomains()
    {
        return parent::runCommand('domain-list_domains');
    }

    /**
     * Dump a list of all domain registrations you have registered with Dreamhost,
     * including ones that have expired recently enough that you can still renew
     * them from the panel.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listRegistrations()
    {
        return parent::runCommand('domain-list_registrations');
    }

   /**
     * Checks to see if a domain name is available to be registered.
     * Must be a valid top level domain.
     *
     * @param  String $domain
     * @return Dreamhost\HttpClient\Response
     */
	public static function registrationAvailable($domain)
	{
        if (! self::isValidTLD($domain)) {
            throw new InvalidDomainTLDException('Invalid top level domain specified');
        }

        if (! self::isValidDomain($domain)) {
            throw new InvalidDomainNameException('Invalid sub-domain name specified');
        }

        return parent::runCommand('domain-registration_available', [
            'domain'  => $domain,
        ]);
	}

    /**
     * Check if domain has a valid tld, as required by Dreamhost API
     * 
     * @param  String  $domain
     * @return boolean
     */
    public static function isValidTLD($domain) {
        $values = explode(".", $domain);
        $last = strtolower(end($values));

        return in_array($last, self::$validTLDS);
    }

    /**
     * Check if domain is valid and not specified as a subdomain
     * 
     * @param  String  $domain
     * @return boolean
     */
    public static function isValidDomain($domain) {
        $values = explode(".", $domain);

        if (sizeof($values) > 2) { return false; }

        return true;
    }
}
