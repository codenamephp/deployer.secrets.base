<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\test\Secret\Proxy\String;

use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Payload\PayloadInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\WithClientAsClassMember;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;
use PHPUnit\Framework\TestCase;

final class WithClientAsClassMemberTest extends TestCase {

  public function test__construct() : void {
    $secret = $this->createMock(SecretInterface::class);
    $client = $this->createMock(ClientInterface::class);

    $sut = new WithClientAsClassMember($client, $secret);

    self::assertSame($secret, $sut->secret);
    self::assertSame($client, $sut->client);
  }

  public function testGetName() : void {
    $secret = $this->createMock(SecretInterface::class);
    $secret->expects(self::once())->method('getName')->willReturn('name');

    $sut = new WithClientAsClassMember($this->createMock(ClientInterface::class), $secret);

    self::assertSame('name', $sut->getName());
  }

  public function testGetVersion() : void {
    $secret = $this->createMock(SecretInterface::class);
    $secret->expects(self::once())->method('getVersion')->willReturn('version');

    $sut = new WithClientAsClassMember($this->createMock(ClientInterface::class), $secret);

    self::assertSame('version', $sut->getVersion());
  }

  public function testFetchPayload() : void {
    $secret = $this->createMock(SecretInterface::class);

    $payload = $this->createMock(PayloadInterface::class);

    $client = $this->createMock(ClientInterface::class);
    $client->expects(self::once())->method('fetchPayload')->with($secret)->willReturn($payload);

    $sut = new WithClientAsClassMember($client, $secret);

    self::assertSame($payload, $sut->fetchPayload());
    self::assertSame($payload, $sut->fetchPayload());
    self::assertSame($payload, $sut->fetchPayload());
  }

  public function testGetProject() : void {
    $secret = $this->createMock(SecretInterface::class);
    $secret->expects(self::once())->method('getProject')->willReturn('project');

    $sut = new WithClientAsClassMember($this->createMock(ClientInterface::class), $secret);

    self::assertSame('project', $sut->getProject());
  }

  public function test__toString() : void {
    $secret = $this->createMock(SecretInterface::class);

    $payload = $this->createMock(PayloadInterface::class);
    $payload->expects(self::once())->method('getContent')->willReturn('content');

    $client = $this->createMock(ClientInterface::class);
    $client->expects(self::once())->method('fetchPayload')->with($secret)->willReturn($payload);

    $sut = new WithClientAsClassMember($client, $secret);

    self::assertSame('content', (string) $sut);
  }
}
