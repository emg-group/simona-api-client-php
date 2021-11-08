# SIMONA API client PHP

PHP implementation of the SIMONA IT Tool's public API

## Getting started

### Installation

This package is recommended to be installed using composer.

```bash
# CLI
$ composer require emg-systems/simona-api-client-php
```
```json lines
// Using composer.json
"require": {
  "emg-systems/simona-api-client-php": "^1.0.0"
}
```
### Running the test

This package contains PHPUnit tests covering all the implemented endpoints of the API.

```bash
$ ./vendor/bin/phpunit test --configuration .phpunit.xml --coverage-text
```

### Example

```php
// Create an instance of the API client
$client = new Client();

// Load monitoring sites in Hungary
$monitoringSites = $client->monitoringSites('hu');

// Load water quality status at the first monitoring site
$waterQuality = $client->waterQuality($monitoringSites[0]->thematicId);
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/emg-group/simona-api-client-php/tags).

## Authors

* **Bese Pál**, *EMG Group*

## License

This project is distributed under GPL-3.0 - see the [LICENCE](LICENCE) file for details.
