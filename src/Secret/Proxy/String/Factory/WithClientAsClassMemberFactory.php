<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory;

use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\StringProxyInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\WithClientAsClassMember;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;

/**
 * Uses the client from the constructor and creates instances of WithClientAsClassMember. The multiple just maps the array of secrets to the build method.
 */
final class WithClientAsClassMemberFactory implements StringProxyFactoryInterface {

  public function __construct(
    public readonly ClientInterface $client,
  ) {}

  public function build(SecretInterface $secret) : StringProxyInterface {
    return new WithClientAsClassMember($this->client, $secret);
  }

  public function buildMultiple(SecretInterface ...$secrets) : array {
    return array_map(fn(SecretInterface $secret) => $this->build($secret), $secrets);
  }
}
