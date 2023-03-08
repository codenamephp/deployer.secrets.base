<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\Secret\Payload\Factory;

use de\codenamephp\deployer\secrets\base\Secret\Payload\PayloadInterface;

interface FactoryInterface {

  public function build(string $content): PayloadInterface;
}