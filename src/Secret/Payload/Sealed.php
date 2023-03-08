<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Payload;

/**
 * Read-only class for a sealed secret payload
 */
final class Sealed implements PayloadInterface {

  public function __construct(public readonly string $content) {}

  public function getContent() : string {
    return $this->content;
  }
}