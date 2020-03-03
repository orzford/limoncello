[![Project Management](https://img.shields.io/badge/project-management-blue.svg)](https://waffle.io/limoncello-php/framework)
[![License](https://img.shields.io/github/license/limoncello-php/framework.svg)](https://packagist.org/packages/limoncello-php/framework)

## Testing

```
composer test
```

The command above will run

- Code coverage tests for all components (`phpunit`) except `Contracts`.
- Code style checks for for all components (`phpcs`).
- Code checks for all components (`phpmd`).

Requirements

- 100% test coverage.
- zero issues from both `phpcs` and `phpmd`.

### Component Status

| Component          | Build Status  | Test Coverage  |
| -------------------|:-------------:| :-------------:|
| Uuid        | [![Build Status](https://travis-ci.org/orzford/limoncello-uuid.svg?branch=master)](https://travis-ci.org/orzford/limoncello-uuid) | [![Code Coverage](https://scrutinizer-ci.com/g/orzford/limoncello-uuid/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/orzford/limoncello-uuid/?branch=master) |
