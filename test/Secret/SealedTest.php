<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\test\Secret;

use de\codenamephp\platform\secretsManager\base\Secret\Sealed;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class SealedTest extends TestCase {

  public function testGetName() : void {
    $sut = new Sealed('name', 'project', 'version');

    self::assertSame('name', $sut->getName());
  }

  public function test__construct() : void {
    $sut = new Sealed('name', 'project');

    self::assertSame('name', $sut->name);
    self::assertSame('project', $sut->project);
    self::assertSame('latest', $sut->version);
  }

  public function test__construct_withVersion() : void {
    $sut = new Sealed('name', 'project', 'version');

    self::assertSame('name', $sut->name);
    self::assertSame('project', $sut->project);
    self::assertSame('version', $sut->version);
  }

  public function test__construct_withEmptyName() : void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Name must not be empty');

    new Sealed('', 'project', 'version');
  }

  public function test__construct_withEmptyProject() : void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Project must not be empty');

    new Sealed('name', '', 'version');
  }

  public function test__construct_withEmptyVersion() : void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Version must not be empty');

    new Sealed('name', 'project', '');
  }

  public function testGetProject() : void {
    $sut = new Sealed('name', 'project', 'version');

    self::assertSame('project', $sut->getProject());
  }

  public function testGetVersion() : void {
    $sut = new Sealed('name', 'project', 'version');

    self::assertSame('version', $sut->getVersion());
  }
}
