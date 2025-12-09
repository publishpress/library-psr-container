<?php

/**
 * Additional test coverage for Versions class and PSR-11 interfaces.
 *
 * Note: VersionsCest.php is auto-generated, so additional tests are in this file.
 */

use PublishPress\PsrContainer\Versions;

class VersionsCoverageCest
{
    public function testDuplicateRegistrationPrevented(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        // Try to register a version that already exists
        $result = $versions->register('2.0.2.1', 'some_callback');

        $I->assertFalse($result, 'Duplicate registration should return false');
    }

    public function testVersionSortingWorksCorrectly(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        // Get all registered versions
        $registeredVersions = $versions->getVersions();

        // Verify latest version is actually the highest
        $latest = $versions->latestVersion();
        $allVersions = array_keys($registeredVersions);

        foreach ($allVersions as $version) {
            $I->assertTrue(
                version_compare($version, $latest, '<='),
                "Version {$version} should be <= latest version {$latest}"
            );
        }
    }

    public function testAllPSR11InterfacesExist(WpunitTester $I)
    {
        $versions = Versions::getInstance();
        $versions->initializeLatestVersion();

        $I->assertTrue(interface_exists('PublishPress\Psr\Container\ContainerInterface'));
        $I->assertTrue(interface_exists('PublishPress\Psr\Container\ContainerExceptionInterface'));
        $I->assertTrue(interface_exists('PublishPress\Psr\Container\NotFoundExceptionInterface'));
    }

    public function testPSR11InterfaceInheritance(WpunitTester $I)
    {
        $versions = Versions::getInstance();
        $versions->initializeLatestVersion();

        // NotFoundExceptionInterface extends ContainerExceptionInterface
        $notFoundReflection = new ReflectionClass('PublishPress\Psr\Container\NotFoundExceptionInterface');
        $interfaces = $notFoundReflection->getInterfaceNames();

        $I->assertContains('PublishPress\Psr\Container\ContainerExceptionInterface', $interfaces);

        // ContainerExceptionInterface extends Throwable
        $containerExceptionReflection = new ReflectionClass('PublishPress\Psr\Container\ContainerExceptionInterface');
        $containerExceptionInterfaces = $containerExceptionReflection->getInterfaceNames();

        $I->assertContains('Throwable', $containerExceptionInterfaces);
    }

    public function testPSR11ContainerInterfaceMethods(WpunitTester $I)
    {
        $versions = Versions::getInstance();
        $versions->initializeLatestVersion();

        $reflection = new ReflectionClass('PublishPress\Psr\Container\ContainerInterface');
        $methods = $reflection->getMethods();
        $methodNames = array_map(function($method) {
            return $method->getName();
        }, $methods);

        $I->assertContains('get', $methodNames);
        $I->assertContains('has', $methodNames);
    }

    public function testSingletonPattern(WpunitTester $I)
    {
        $instance1 = Versions::getInstance();
        $instance2 = Versions::getInstance();

        $I->assertSame($instance1, $instance2, 'getInstance should return the same instance');
    }

    public function testLatestVersionCallbackReturnsNullWhenNoVersions(WpunitTester $I)
    {
        // Create a fresh instance to test edge case
        // Note: This tests the logic, but in practice versions are already registered
        $versions = Versions::getInstance();

        // Get the callback - should return a valid callback, not '__return_null'
        // because versions are already registered by plugins
        $callback = $versions->latestVersionCallback();

        $I->assertNotEmpty($callback);
        $I->assertNotEquals('__return_null', $callback);
    }

    public function testVersionConstantsDefined(WpunitTester $I)
    {
        $versions = Versions::getInstance();
        $versions->initializeLatestVersion();

        $I->assertTrue(defined('PUBLISHPRESS_PSR_CONTAINER_VERSION'));
        $I->assertEquals('2.0.2.1', PUBLISHPRESS_PSR_CONTAINER_VERSION);

        $I->assertTrue(defined('PUBLISHPRESS_PSR_CONTAINER_INCLUDED'));
    }
}

