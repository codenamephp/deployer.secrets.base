# platform.secretsManager.base

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.secrets.base)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.secrets.base)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.secrets.base)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.secrets.base)
![CI](https://github.com/codenamephp/deployer.secrets.base/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.secrets.base)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.secrets.base)

A base package to provide common interface for secret manager integration with the intent to make them easily exchangeable.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/platform.secretsmanager.base` in your cli which should install the latest version for you.

## Usage

This package provides the basic interfaces for secrets, payloads and a client. Use this package in your actual implementation and
just build implementations against services.
