<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret;

use de\codenamephp\platform\secretsManager\base\Secret\Payload\PayloadInterface;

/**
 * Interface for a secret that has a payload
 */
interface WithPayloadInterface extends SecretInterface {

  /**
   * Gets the payload that belongs to the secret
   *
   * @return PayloadInterface
   */
  public function getPayload(): PayloadInterface;
}