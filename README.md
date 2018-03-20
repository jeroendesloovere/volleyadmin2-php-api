# volleyadmin2-php-api
This PHP class can get the volleybal matches/calendar.

# VolleyAdmin2 PHP API
[![Latest Stable Version](http://img.shields.io/packagist/v/jeroendesloovere/volleyadmin2-php-api.svg)](https://packagist.org/packages/jeroendesloovere/volleyadmin2-php-api)
[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/jeroendesloovere/volleyadmin2-php-api/blob/master/LICENSE)
[![Build Status](http://img.shields.io/travis/jeroendesloovere/volleyadmin2-php-api.svg)](https://travis-ci.org/jeroendesloovere/volleyadmin2-php-api)

> This PHP class can get the volleybal matches/calendar.

## Usage

### Installation

```
composer require jeroendesloovere/volleyadmin2-php-api
```
> This will install the latest version of vcard using [Composer](https://getcomposer.org).

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

``` bash
$ phpunit
```

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
