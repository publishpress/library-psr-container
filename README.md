Container interface
==============

This repository holds all interfaces related to [PSR-11 (Container Interface)][psr-url], prefixed for PublishPress.

Note that this is not a Container implementation of its own. It is merely abstractions that describe the components of a Dependency Injection Container.

The installable [package][package-url] and [implementations][implementation-url] are listed on Packagist.

[psr-url]: https://www.php-fig.org/psr/psr-11/
[package-url]: https://packagist.org/packages/psr/container
[implementation-url]: https://packagist.org/providers/psr/container-implementation

## How to update the prefixed library

1. Run the command `composer update`;
2. Commit the changes;
3. Create a new release on GitHub naming it with the original version number and incrementing the fourth digit with the current iteration;
