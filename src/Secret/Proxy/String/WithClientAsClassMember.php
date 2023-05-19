<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Proxy\String;

use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Payload\PayloadInterface;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;

/**
 * Proxy that just holds the secret, the client and the payload as members. When the payload is needed and is null
 * it is resolved with the client and set. All further calls to the payload will therefore use the resolved payload.
 *
 * Everything else is just delegated to the secret.
 */
final class WithClientAsClassMember implements StringProxyInterface {

  public ?PayloadInterface $payload = null;

  public function __construct(
    public readonly ClientInterface $client,
    public readonly SecretInterface $secret
  ) {}

  public function __toString() : string {
    return $this->fetchPayload()->getContent();
  }

  public function getName() : string {
    return $this->secret->getName();
  }

  public function getProject() : string {
    return $this->secret->getProject();
  }

  public function getVersion() : string {
    return $this->secret->getVersion();
  }

  public function fetchPayload() : PayloadInterface {
    return $this->payload ??= $this->client->fetchPayload($this->secret);
  }
}
