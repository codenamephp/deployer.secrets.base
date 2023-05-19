<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory;

use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\StringProxyInterface;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;

/**
 * Interface for factories that create string proxy instances
 */
interface StringProxyFactoryInterface {

  /**
   * Builds a single proxy instance using the given secret
   *
   * @param SecretInterface $secret The secret to build the proxy for
   * @return StringProxyInterface The built proxy
   */
  public function build(SecretInterface $secret) : StringProxyInterface;

  /**
   * Builds multiple proxy instances using the given secrets. Implementations MUST preserve the order and keys (if given) of the secrets.
   * Reminder you can use named parameters in variadic to use as array keys.
   *
   * @param SecretInterface ...$secrets The secrets to build the proxies for
   * @return array<StringProxyInterface> The built proxies
   */
  public function buildMultiple(SecretInterface ...$secrets) : array;
}
