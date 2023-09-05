<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\test\Secret\Proxy\String\Factory;

use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory\LazyWithClientAsClassMemberFactory;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\WithClientAsClassMember;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;
use PHPUnit\Framework\TestCase;

final class LazyWithClientAsClassMemberFactoryTest extends TestCase {

  public function testBuild() : void {
    $client = $this->createMock(ClientInterface::class);
    $secret = $this->createMock(SecretInterface::class);

    $sut = new LazyWithClientAsClassMemberFactory(static fn() => $client);

    $proxy = $sut->build($secret);

    self::assertInstanceOf(WithClientAsClassMember::class, $proxy);
    self::assertSame($client, $proxy->client);
    self::assertSame($secret, $proxy->secret);
  }

  public function test__construct() : void {
    $closure = static fn() => null;

    $sut = new LazyWithClientAsClassMemberFactory($closure);

    self::assertSame($closure, $sut->clientFactory);
  }

  public function testGetProxyFactory() : void {
    $client = $this->createMock(ClientInterface::class);

    $sut = new LazyWithClientAsClassMemberFactory(static fn() => $client);
    $proxyFactory = $sut->getProxyFactory();

    self::assertSame($client, $proxyFactory->client);
    self::assertSame($proxyFactory, $sut->getProxyFactory());
  }

  public function testBuildMultiple() : void {
    $client = $this->createMock(ClientInterface::class);
    $secret1 = $this->createMock(SecretInterface::class);
    $secret2 = $this->createMock(SecretInterface::class);
    $secret3 = $this->createMock(SecretInterface::class);

    $sut = new LazyWithClientAsClassMemberFactory(static fn() => $client);

    $proxies = $sut->buildMultiple($secret1, $secret2, $secret3);

    self::assertContainsOnlyInstancesOf(WithClientAsClassMember::class, $proxies);
    self::assertCount(3, $proxies);
    self::assertSame($client, $proxies[0]->client);
    self::assertSame($secret1, $proxies[0]->secret);
    self::assertSame($client, $proxies[1]->client);
    self::assertSame($secret2, $proxies[1]->secret);
    self::assertSame($client, $proxies[2]->client);
    self::assertSame($secret3, $proxies[2]->secret);
  }
}
