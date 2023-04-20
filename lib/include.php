<?php

/*****************************************************************
 * This file is generated on composer update command by
 * a custom script. 
 * 
 * Do not edit it manually!
 ****************************************************************/

namespace PublishPress\PsrContainer;

use function add_action;
use function do_action;

if (! function_exists('add_action')) {
    return;
}

if (! function_exists(__NAMESPACE__ . '\register2Dot0Dot1Dot4')) {
    if (! class_exists('PublishPress\PsrContainer\Versions')) {
        require_once __DIR__ . '/Versions.php';

        add_action('plugins_loaded', [Versions::class, 'initializeLatestVersion'], 1, 0);
    }

    add_action('plugins_loaded', __NAMESPACE__ . '\register2Dot0Dot1Dot4', 1, 0);

    function register2Dot0Dot1Dot4()
    {
        if (! interface_exists('PublishPress\Psr\Container\ContainerInterface')) {
            $versions = Versions::getInstance();
            $versions->register('2.0.1.4', __NAMESPACE__ . '\initialize2Dot0Dot1Dot4');
        }
    }

    function initialize2Dot0Dot1Dot4()
    {
        require_once __DIR__ . '/autoload.php';
        do_action('publishpress_psr_container_2Dot0Dot1Dot4_initialized');
    }
}
