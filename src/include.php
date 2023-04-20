<?php

/*****************************************************************
 * This file is generated on composer update command by
 * a custom script. 
 * 
 * Do not edit it manually!
 ****************************************************************/

namespace PublishPress\PsrContainer;

if (! function_exists(__NAMESPACE__ . '\2Dot0Dot1Dot1')) {
    if (! class_exists('PublishPress\PsrContainer\Versions')) {
        require_once __DIR__ . '/Versions.php';

        add_action('plugins_loaded', [Versions::class, 'initializeLatestVersion'], 1, 0);
    }

    add_action('plugins_loaded', __NAMESPACE__ . '\register2Dot0Dot1Dot1', 1, 0);

    function register2Dot0Dot1Dot1()
    {
        if (! interface_exists('PublishPress\Psr\Container\ContainerInterface')) {
            $versions = Versions::getInstance();
            $versions->register('2.0.1.1', __NAMESPACE__ . '\initialize2Dot0Dot1Dot1');
        }
    }

    function initialize2Dot0Dot1Dot1()
    {
        require_once __DIR__ . '/../lib/autoload.php';
        do_action('publishpress_psr_container_2Dot0Dot1Dot1_initialized');
    }
}
