<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Payload\Factory;

use de\codenamephp\platform\secretsManager\base\Secret\Payload\PayloadInterface;

interface FactoryInterface {

  public function build(string $content): PayloadInterface;
}