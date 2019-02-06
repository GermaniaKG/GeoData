# Germania KG · GeoData

[![Packagist](https://img.shields.io/packagist/v/germania-kg/geodata.svg?style=flat)](https://packagist.org/packages/germania-kg/geodata)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/geodata.svg)](https://packagist.org/packages/germania-kg/geodata)
[![Build Status](https://img.shields.io/travis/GermaniaKG/GeoData.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/GeoData)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/build-status/master)




## Installation

```bash
$ composer require germania-kg/geodata
```




## Interfaces 

### GeoDataProviderInterface
```php
<?php
use Germania\GeoData\GeoDataProviderInterface;
```

#### Methods

```php
/**
 * @return null|GeoDataInterface
 */
public function getGeoData();
```



### GeoDataInterface

```php
<?php
use Germania\GeoData\GeoDataInterface;
```

#### Methods

```php
/**
 * @return float
 */
public function getLatitude();

/**
 * @return float
 */
public function getLongitude();


/**
 * @return array[float]
 */
public function getLatLon();
```

## Traits

### GeoDataTrait

The **GeoDataTrait** provides public **latitude** and **longitude** properties as well as the methods 
prescribed by **GeoDataInterface**:

```php
<?php
use Germania\GeoData\GeoDataTrait;

class MyGeoData
{
	use GeoDataTrait;
}

$object = new MyGeoData;

// Properties
echo $object->latitude;
echo $object->longitude;

// GeoDataProviderInterface methods
echo $object->getLatitude();
echo $object->getLongitude();
$coords = $object->getLatLon();
```

### GeoDataProviderTrait

The **GeoDataProviderTrait** provides a public **geodata** property as well as a **getGeoData** method 
prescribed by **GeoDataProviderInterface:**

```php
<?php
use Germania\GeoData\GeoDataProviderTrait;

class MyGeoDataProvider
{
	use GeoDataProviderTrait;
}

$object = new MyGeoDataProvider;

// Properties
$object->geodata;

// GeoDataProviderInterface methods
$object->getGeoData();

```


## Filters

### NotEmptyGeoDataFilterIterator

Accepts any **Traversable** and filters for **GeoDataInterface** or **GeoDataProviderInterface** items whose *getLatitude* and *getLongitude* results are not empty.

## Development

```bash
$ git clone https://github.com/GermaniaKG/Geodata.git
$ cd Geodata
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```


