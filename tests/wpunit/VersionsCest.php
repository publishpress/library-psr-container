<?php

/*****************************************************************
 * This file is generated on composer update command by
 * a custom script. 
 * 
 * Do not edit it manually!
 ****************************************************************/

use PublishPress\PsrContainer\Versions;

class VersionsCest
{
    public function testAllVersionsAreRegistered(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $registeredVersions = $versions->getVersions();

        $I->assertNotEmpty($registeredVersions);
        $I->assertEquals([
            '2.0.0.1' => 'PublishPress\PsrContainer\initialize2Dot0Dot0Dot1',
            '2.0.0.2' => 'PublishPress\PsrContainer\initialize2Dot0Dot0Dot2',
            '2.0.1.7' => 'PublishPress\PsrContainer\initialize2Dot0Dot1Dot7',
        ], $registeredVersions);
    }

    public function testLatestVersionIsTheCurrentVersion(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersion = $versions->latestVersion();

        $I->assertEquals('2.0.1.7', $latestVersion);
    }

    public function testLatestVersionCallbackIsTheLastOne(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersionCallback = $versions->latestVersionCallback();

        $I->assertEquals('PublishPress\PsrContainer\initialize2Dot0Dot1Dot7', $latestVersionCallback);
    }

    public function testInitializeLatestVersion(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $versions->initializeLatestVersion();

        $I->assertTrue(interface_exists('PublishPress\Psr\Container\ContainerInterface'));

        $didAction = (bool)did_action('publishpress_psr_container_2Dot0Dot1Dot7_initialized');
        $I->assertTrue($didAction);
    }
}
