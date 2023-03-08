<?php declare(strict_types=1);

namespace de\codenamephp\deployer\secrets\base\Secret;

use InvalidArgumentException;

final class Sealed implements SecretInterface {

  public function __construct(public readonly string $name,
                              public readonly string $project,
                              public readonly string $version = 'latest') {
    match (true) {
      $name === '' => throw new InvalidArgumentException('Name must not be empty'),
      $project === '' => throw new InvalidArgumentException('Project must not be empty'),
      $this->version === '' => throw new InvalidArgumentException('Version must not be empty'),
      default => null
    };
  }

  public function getName() : string {
    return $this->name;
  }

  public function getProject() : string {
    return $this->project;
  }

  public function getVersion() : string {
    return $this->version;
  }
}