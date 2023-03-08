<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Payload\Factory;

use de\codenamephp\platform\secretsManager\base\Secret\Payload\PayloadInterface;

final class Sealed implements FactoryInterface {

  public function build(string $content) : PayloadInterface {
    return new \de\codenamephp\platform\secretsManager\base\Secret\Payload\Sealed($content);
  }
}