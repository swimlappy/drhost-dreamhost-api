<?php

namespace Dreamhost\Api;

/**
 * The mysql API module allows managing mysql databases and users.
 *
 * http://wiki.dreamhost.com/API/Mysql_commands
 */
class MySQL extends ApiResource
{
    /**
     * List of all active MySQL databases on all accounts
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listDatabases()
    {
        return parent::runCommand('mysql-list_dbs');
    }

    /**
     * List of all active MySQL hostnames, and the database
     * servers they refer to, for all accounts you can access.
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listHostnames()
    {
        return parent::runCommand('mysql-list_hostnames');
    }

    /**
     * Add new MySQL hostname
     *
     * @param  String $hostname
     * @return Dreamhost\HttpClient\Response
     */
    public static function addHostname($hostname)
    {
        return parent::runCommand('mysql-add_hostname', [
            'hostname' => $hostname
        ]);
    }

    /**
     * Remove MySQL hostname
     *
     * @param  String $hostname
     * @return Dreamhost\HttpClient\Response
     */
    public static function removeHostname($hostname)
    {
        return parent::runCommand('mysql-remove_hostname', [
            'hostname' => $hostname
        ]);
    }

    /**
     * List all MySQL users and their privileges
     *
     * @return Dreamhost\HttpClient\Response
     */
    public static function listUsers()
    {
        return parent::runCommand('mysql-list_users');
    }
}
