<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\test\Secret\Payload;

use de\codenamephp\deployer\secrets\base\Secret\Payload\Sealed;
use PHPUnit\Framework\TestCase;

final class SealedTest extends TestCase {

  public function test__construct() : void {
    $sut = new Sealed('some content');

    self::assertSame('some content', $sut->content);
  }

  public function testGetContent() : void {
    $sut = new Sealed('some content');

    self::assertSame('some content', $sut->getContent());
  }
}
