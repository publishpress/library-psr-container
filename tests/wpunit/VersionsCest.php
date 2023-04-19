<?php

use PublishPress\VersionsManager\Versions;

class VersionsCest
{
    public function testAllVersionsAreRegistered(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $registeredVersions = $versions->getVersions();

        $I->assertNotEmpty($registeredVersions);
        $I->assertEquals([
            '2.0.0' => 'PublishPress\PsrContainer\initialize2Dot0Dot0',
            '2.2.0' => 'PublishPress\PsrContainer\initialize2Dot2Dot0',
            '3.0.0' => 'PublishPress\PsrContainer\initialize3Dot0Dot0',
        ], $registeredVersions);
    }

    public function testLatestVersionIs3Dot0Dot0(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersion = $versions->latestVersion();

        $I->assertEquals('3.0.0', $latestVersion);
    }

    public function testLatestVersionCallbackIs3Dot0Dot0(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersionCallback = $versions->latestVersionCallback();

        $I->assertEquals('PublishPress\PsrContainer\initialize3Dot0Dot0', $latestVersionCallback);
    }

    public function testInitializeLatestVersion(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $versions->initializeLatestVersion();

        $I->assertTrue(interface_exists('PublishPress\Psr\Container\ContainerInterface'));

        $didAction = (bool)did_action('publishpress_psr_container_3_dot_0_dot_0_initialized');
        $I->assertTrue($didAction);
    }
}
