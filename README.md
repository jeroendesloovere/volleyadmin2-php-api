# VolleyAdmin2 PHP API
[![Latest Stable Version](http://img.shields.io/packagist/v/jeroendesloovere/volleyadmin2-php-api.svg)](https://packagist.org/packages/jeroendesloovere/volleyadmin2-php-api)
[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/jeroendesloovere/volleyadmin2-php-api/blob/master/LICENSE)
[![Build Status](http://img.shields.io/travis/jeroendesloovere/volleyadmin2-php-api.svg)](https://travis-ci.org/jeroendesloovere/volleyadmin2-php-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jeroendesloovere/volleyadmin2-php-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jeroendesloovere/volleyadmin2-php-api/?branch=master)

> This PHP class can get the volleybal matches/calendar from the `VolleyAdmin2` API.

## Usage

### Installation

```
composer require jeroendesloovere/volleyadmin2-php-api
```
> This will install the latest version of this library using [Composer](https://getcomposer.org).

### Example

``` php
use JeroenDesloovere\VolleyAdmin2\VolleyAdmin2;

// Fill in these custom variables
$clubNumber = 'W-1132';
$provinceId = 9;
$seriesId = '2 PDA'; // Tweede provinciale dames A

$api = new VolleyAdmin2();

$matches = $api->getMatches(
    $seriesId,
    $provinceId,
    $clubNumber
);

$series = $api->getSeries($provinceId);

$standings = $api->getStandings(
    $seriesId,
    $provinceId
);

```
> [View all examples](/examples/) or check [the VolleyAdmin2 class](/src/).

### Tests

You can execute the tests using:
``` bash
vendor/bin/phpunit tests
```

### Coding Syntax

We use [squizlabs/php_codesniffer](https://packagist.org/packages/squizlabs/php_codesniffer) to maintain the code standards.
Type the following to execute them:
```bash
# To view the code errors
vendor/bin/phpcs --standard=psr2 --extensions=php --warning-severity=0 --report=full "src"

# OR to fix the code errors
vendor/bin/phpcbf --standard=psr2 --extensions=php --warning-severity=0 --report=full "src"
```
> [Read documentation about the code standards](https://github.com/squizlabs/PHP_CodeSniffer/wiki)

## Documentation

The class is well documented inline. If you use a decent IDE you'll see that each method is documented with PHPDoc.

## Contributing

Contributions are **welcome** and will be fully **credited**.

### Pull Requests

> To add or update code

- **Coding Syntax** - Please keep the code syntax consistent with the rest of the package.
- **Add unit tests!** - Your patch won't be accepted if it doesn't have tests.
- **Document any change in behavior** - Make sure the README and any other relevant documentation are kept up-to-date.
- **Consider our release cycle** - We try to follow [semver](http://semver.org/). Randomly breaking public APIs is not an option.
- **Create topic branches** - Don't ask us to pull from your master branch.
- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.
- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.

### Issues

> For bug reporting or code discussions.

More info on how to work with GitHub on help.github.com.

## Credits

- [Jeroen Desloovere](https://github.com/jeroendesloovere)
- [All Contributors](https://github.com/jeroendesloovere/volleyadmin2-php-api/contributors)

## License

The module is licensed under [MIT](./LICENSE.md). In short, this license allows you to do everything as long as the copyright statement stays present.
