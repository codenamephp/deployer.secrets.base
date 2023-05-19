# platform.secretsManager.base

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.secrets.base)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.secrets.base)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.secrets.base)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.secrets.base)
![CI](https://github.com/codenamephp/deployer.secrets.base/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.secrets.base)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.secrets.base)

A base package to provide common interface for secret manager integration with the intent to make them easily exchangeable.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/platform.secretsmanager.base` in your cli which should install the latest version for you.

## Usage

This package provides the basic interfaces for secrets, payloads and a client. Use this package in your actual implementation and
just build implementations against services.

### Proxy

There is a simple, lightweight proxy system in place. This is used to load secrets lazily and ideally only once.

Example:

```php
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory\WithClientAsClassMemberFactory;
use de\codenamephp\platform\secretsManager\base\Secret\Sealed;

$client = new SomeClientImplementation();
$factory = new WithClientAsClassMemberFactory($client);

$secret = $factory->build(new Sealed('someSecretName', 'some-project'));
$multipleSecrets = $factory->buildMultiple(
  another: new Sealed('anotherSecretName', 'some-project'),
  more: new Sealed('moreSecretName', 'some-project'),
); //remember you can use parameter names as array keys for variadic

$allSecrets = [
  'some' => $secret,
  ...$multipleSecrets, //simple spread is possible
];
```

The proxy interface extends \Stringable so it should be usable wherever a string would have been used.

#### A not when using with Deployer

Because of the way deployer fetches the secrets you should wrap the values in closures. This is because
when fetching the configs Deployer does checks for closures and return them "as is". But the else path just
passes the value to preg_replace and assumes an array callable so this will return null in the end.

```php
$deployerFunctions->host('production')
  ->setHostname('some-host.com')
  ->set('database', static fn() => [ //this closure fixes the issue
    'name' => 'some-db',
    ...$stringProxyFactory->buildMultiple(
      user: new Sealed('db_user', 'my-project'), 
      password: new Sealed('db_password', 'my-project')
    ),
  ]);
```
