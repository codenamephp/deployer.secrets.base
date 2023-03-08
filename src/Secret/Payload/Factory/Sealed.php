<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\Secret\Payload\Factory;

use de\codenamephp\deployer\secrets\base\Secret\Payload\PayloadInterface;

final class Sealed implements FactoryInterface {

  public function build(string $content) : PayloadInterface {
    return new \de\codenamephp\deployer\secrets\base\Secret\Payload\Sealed($content);
  }
}