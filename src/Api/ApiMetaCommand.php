<?php

namespace Dreamhost\Api;

/**
 * API Metacommands give you information about the API
 * such as what commands and API keys are available on your account.
 *
 * http://wiki.dreamhost.com/API/Api_commands
 */
class ApiMetaCommand extends ApiResource
{
    /**
     * Dump a list of all commands this API Key has access to
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listAccessibleCmds()
    {
        return parent::runCommand('api-list_accessible_cmds');
    }

    /**
     * List all available keys
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listKeys()
    {
        return parent::runCommand('api-list_keys');
    }
}
