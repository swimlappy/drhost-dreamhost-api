<?php

namespace Dreamhost\Api;

/**
 * The mysql API module allows managing mysql databases and users.
 *
 * http://wiki.dreamhost.com/API/Mysql_commands
 */
class MySQL extends ApiResource
{
    public static $defaultHostname = '%.dreamhost.com';

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

    /**
     * Add a new MySQL user to a database
     *
     * @param String $database
     * @param String $user
     * @param String $password
     * @param array  $permissions
     * @return Dreamhost\HttpClient\Response
     */
    public static function addUser($database, $user, $password, $hostnames = [], $permissions = [])
    {
        if (count($hostnames) < 1) {
            $hostnameList = self::$defaultHostname;
        }
        // A newline separated list of hosts
        else {
            $hostnameList = implode(PHP_EOL, $hostnames);
        }

        $params = array_merge([
            'db'        => $database,
            'user'      => $user,
            'password'  => $password,
            'hostnames' => $hostnameList,
        ],
            self::preparePermissions($permissions)
        );

        return parent::runCommand('mysql-add_user', $params);
    }

    /**
     * Remove a MySQL user from a database
     *
     * @param  String $database
     * @param  String $user
     * @param  array  $permissions
     * @return Dreamhost\HttpClient\Response
     */
    public static function removeUser($database, $user, $permissions = [])
    {
        $params = array_merge([
            'db'        => $database,
            'user'      => $user,
        ],
            self::preparePermissions($permissions)
        );

        return parent::runCommand('mysql-remove_user', $params);
    }

    /**
     * Merge default permissions and transform to 'Y' / 'N' format
     *
     * Yeap, I don't like it either
     * http://www.reactiongifs.com/wp-content/gallery/wtf/wtf%20(2).gif
     *
     * @param  array  $newPermissions
     * @return array
     */
    protected static function preparePermissions(array $newPermissions = [])
    {
        $permissions = array_replace_recursive([
            'select' => true,
            'insert' => true,
            'update' => true,
            'delete' => true,
            'create' => true,
            'drop'   => true,
            'index'  => true,
            'alter'  => true,
        ], $newPermissions);

        return array_map(function ($permission) {

            // Boolean format, we just check if it's true or false
            // then return Y or N
            if (is_bool($permission)) {
                return $permission ? 'Y' : 'N';
            }

            $permission = strtoupper($permission);

            // If is not Y or N format, we return the
            // default value
            if (! in_array($permission, ['Y', 'N'])) {
                return true;
            }

            // Okie dokie
            return $permission;

        }, $permissions);
    }
}
