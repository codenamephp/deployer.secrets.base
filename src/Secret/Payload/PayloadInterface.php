<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Payload;

/**
 * Interface for a payload of a secret. Contains the content as string and checksums
 */
interface PayloadInterface {

  /**
   * Gets the secret payload as string (so the thing you actually want to use)
   *
   * @return string
   */
  public function getContent() : string;
}