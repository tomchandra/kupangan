<?php

namespace App\Libraries;

use \App\Libraries\CustomOauthStorage;

class Oauth
{
    var $server;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $dsn        = getenv('database.default.DSN');
        $username   = getenv('database.default.username');
        $password   = getenv('database.default.password');

        $storage = new CustomOauthStorage(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        //$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage)); // or any grant type you like!
        //$this->server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
    }
}
