<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\Client;

use de\codenamephp\deployer\secrets\base\Secret\Payload\PayloadInterface;
use de\codenamephp\deployer\secrets\base\Secret\SecretInterface;

/**
 * Interface for a common client that fetches payloads (since the payload is what we care about here)
 */
interface ClientInterface {

  /**
   * Sends a request to the Secret Manager to fetch the payload of a secret
   *
   * @param SecretInterface $secret The secret of the payload
   * @return PayloadInterface
   */
  public function fetchPayload(SecretInterface $secret) : PayloadInterface;
}