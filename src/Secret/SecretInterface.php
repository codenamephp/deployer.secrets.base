<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\Secret;


/**
 * Simple interface for a secret. Most secrets managers need a name, a project the secret is in a version to get for the secret.
 */
interface SecretInterface {

  /**
   * @return string The name of the secret in the Secrets Manager
   */
  public function getName() : string;

  /**
   * @return string The project the secret is in the Secrets Manager
   */
  public function getProject() : string;

  /**
   * @return string The version of the secret te get, should default to latest
   */
  public function getVersion() : string;
}