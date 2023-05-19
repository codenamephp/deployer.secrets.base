<?php declare(strict_types=1);

namespace de\codenamephp\platform\secretsManager\base\Secret\Proxy\String;

use de\codenamephp\platform\secretsManager\base\Secret\SecretInterface;
use Stringable;

/**
 * Interface to proxy a secret that is a string and load it once lazily.
 *
 * Implementations should hold a client and a secret and fetch the payload once when it is needed and cache it.
 */
interface StringProxyInterface extends SecretInterface, Stringable
{

}
