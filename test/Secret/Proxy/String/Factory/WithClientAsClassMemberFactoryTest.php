<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\test\Secret\Proxy\String\Factory;

use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory\WithClientAsClassMemberFactory;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\WithClientAsClassMember;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;
use PHPUnit\Framework\TestCase;

final class WithClientAsClassMemberFactoryTest extends TestCase {

  public function test__construct() : void {
    $client = $this->createMock(ClientInterface::class);

    $sut = new WithClientAsClassMemberFactory($client);

    self::assertSame($client, $sut->client);
  }

  public function testBuild() : void {
    $client = $this->createMock(ClientInterface::class);
    $secret = $this->createMock(SecretInterface::class);

    $sut = new WithClientAsClassMemberFactory($client);

    $result = $sut->build($secret);

    self::assertInstanceOf(WithClientAsClassMember::class, $result);
    self::assertSame($client, $result->client);
    self::assertSame($secret, $result->secret);
  }

  public function testBuildMultiple() : void {
    $client = $this->createMock(ClientInterface::class);
    $secret1 = $this->createMock(SecretInterface::class);
    $secret2 = $this->createMock(SecretInterface::class);

    $sut = new WithClientAsClassMemberFactory($client);

    $result = $sut->buildMultiple($secret1, $secret2);

    self::assertIsArray($result);
    self::assertCount(2, $result);
    self::assertInstanceOf(WithClientAsClassMember::class, $result[0]);
    self::assertSame($client, $result[0]->client);
    self::assertSame($secret1, $result[0]->secret);
    self::assertInstanceOf(WithClientAsClassMember::class, $result[1]);
    self::assertSame($client, $result[1]->client);
    self::assertSame($secret2, $result[1]->secret);
  }
}
