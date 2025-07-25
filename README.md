# phpstan-rules

[![Latest Version](https://img.shields.io/packagist/v/pekral/phpstan-rules.svg?style=flat-square)](https://packagist.org/packages/pekral/phpstan-rules)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)
[![Downloads](https://img.shields.io/packagist/dt/pekral/phpstan-rules?style=flat-square)](https://packagist.org/packages/pekral/phpstan-rules)

---

## 🚀 Introduction

**phpstan-rules** is an extensible package of custom rules for [PHPStan](https://phpstan.org/) that helps you maintain high code quality and consistency in your PHP projects.

---

## 📦 Installation

```bash
composer require --dev pekral/phpstan-rules
```

---

## ⚙️ Usage

1. Add `phpstan.neon` or extend your existing configuration file with this package.
2. Run PHPStan with this extension:

```bash
vendor/bin/phpstan analyse src/
```

---

## 📝 Example configuration (phpstan.neon)

```yaml
includes:
    - vendor/pekral/phpstan-rules/extension.neon

parameters:
    level: max
    paths:
        - src
```

---

## 🔒 Strict and Deprecation Rules

This package is designed to work seamlessly with [phpstan/phpstan-strict-rules](https://github.com/phpstan/phpstan-strict-rules) and [phpstan/phpstan-deprecation-rules](https://github.com/phpstan/phpstan-deprecation-rules). These packages provide extra strict and deprecation-related rules for PHPStan, helping you enforce best practices and avoid deprecated code usage.

To enable these rules, make sure you have both packages installed (they are included in the dependencies) and add them to your `phpstan.neon` configuration:

```yaml
includes:
    - vendor/phpstan/phpstan-strict-rules/rules.neon
    - vendor/phpstan/phpstan-deprecation-rules/rules.neon
    - vendor/pekral/phpstan-rules/extension.neon
```

You can then configure strict rules in the `parameters > strictRules` section of your `phpstan.neon` file. For a full list of available strict rules, see the [phpstan-strict-rules documentation](https://github.com/phpstan/phpstan-strict-rules#rules).

---

## ❓ FAQ

**Q: How do I add a custom rule?**
A: Create your own rule class and add it to the PHPStan configuration.

**Q: How do I run PHPStan only on specific folders?**
A: Adjust the path in the PHPStan command, e.g. `src/`, `app/`.

**Q: How can I contribute?**
A: Open an issue or pull request on [GitHub](https://github.com/pekral/phpstan-rules).

---

## 🔗 Further resources

- [PHPStan](https://phpstan.org/)
- [Official PHPStan documentation](https://phpstan.org/user-guide/getting-started)

---

## 📝 License

This package is licensed under the MIT license.

---

## About

A package for extending PHPStan with custom rules. Suitable for teams and individuals who want to maintain high PHP code quality.
