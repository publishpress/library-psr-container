<?php

namespace PublishPress\PsrContainer;

use PublishPress\VersionsManager\Versions;

if (! function_exists(__NAMESPACE__ . '\\register2Dot0Dot0')) {
    if (! class_exists('PublishPress\\VersionsManager\\Versions')) {
        require_once __DIR__ . '/Versions.php';

        add_action('plugins_loaded', [Versions::class, 'initializeLatestVersion'], 1, 0);
    }

    add_action('plugins_loaded', __NAMESPACE__ . '\\register2Dot0Dot0', 1, 0);

    function register2Dot0Dot0()
    {
        if (! class_exists('PublishPress\\Psr\\Container\\ContainerInterface')) {
            $versions = Versions::getInstance();
            $versions->register('2.0.0', __NAMESPACE__ . '\\initialize2Dot0Dot0');
        }
    }

    function initialize2Dot0Dot0()
    {
        require_once __DIR__ . '/../lib/autoload.php';
    }

    // Support usage in themes - load this version if no plugin has loaded a version yet.
    if (did_action('plugins_loaded') && ! doing_action('plugins_loaded') && ! interface_exists('PublishPress\\Psr\\Container\\ContainerInterface')) {
        initialize2Dot0Dot0();
        do_action('publishpress_psr_container_pre_theme_init');
        Versions::initializeLatestVersion();
    }
}
