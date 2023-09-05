<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\Factory;

use Closure;
use de\codenamephp\platform\secretsManager\base\Client\ClientInterface;
use de\codenamephp\platform\secretsManager\base\Secret\Proxy\String\StringProxyInterface;
use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;

/**
 * Wrapper for the WithClientAsClassMemberFactory that uses a callback to create the client lazy instead of passing it in the constructor. This makes it
 * possible to only create the client when it is actually needed which is useful when some users never need to use anything that needs the client. So they
 * don't even need to install the client library with auth etc.
 */
final class LazyWithClientAsClassMemberFactory implements StringProxyFactoryInterface {

  public WithClientAsClassMemberFactory $proxyFactory;

  /**
   * @param Closure():ClientInterface $clientFactory A closure that returns the client when called. This is used to create the client lazy instead of passing it
   */
  public function __construct(
    public readonly Closure $clientFactory,
  ) {}

  /**
   * @psalm-suppress RedundantPropertyInitializationCheck that's what makes it lazy!
   */
  public function getProxyFactory() : WithClientAsClassMemberFactory {
    return $this->proxyFactory ??= new WithClientAsClassMemberFactory(($this->clientFactory)());
  }

  public function build(SecretInterface $secret) : StringProxyInterface {
    return $this->getProxyFactory()->build($secret);
  }

  public function buildMultiple(SecretInterface ...$secrets) : array {
    return $this->getProxyFactory()->buildMultiple(...$secrets);
  }
}
