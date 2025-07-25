# phpstan-rules

[![Latest Version](https://img.shields.io/packagist/v/pekral/phpstan-rules.svg?style=flat-square)](https://packagist.org/packages/pekral/phpstan-rules)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)

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
