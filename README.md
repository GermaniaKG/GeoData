<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------




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

```php
/**
 * @return float|null
 */
public function getLatitude();

/**
 * @return float|null
 */
public function getLongitude();


/**
 * @return float[]
 */
public function getLatLon();

/**
 * @return string|null
 */
public function getSource();
```


## Traits

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

// Property or GeoDataProviderInterface method
$object->geodata;
$object->getGeoData();

```



## Classes

### GeoDataAbstract

The **GeoDataAbstract** provides public **latitude** and **longitude** properties as well as the methods 
prescribed by **GeoDataInterface**:

```php
<?php
use Germania\GeoData\GeoDataAbstract;

class MyGeoData extends GeoDataAbstract
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



### GeoData

The **GeoData** class extends *GeoDataAbstract* and implements *GeoDataInterface* and also *GeoDataProviderInterface*:

```php
<?php
use Germania\GeoData\GeoData;  

// "Null" object
$geo = new GeoData();
$coords = $object->getLatLon();    // [ null, null]
$coords = $object->getLatitude();  // null
$coords = $object->getLongitude(); // null
echo $geo->getSource(); // null

// With real data
$latitude = 54.0;
$longitude = 10.0;
$description = "provided by Google Maps";

$geo = new GeoData( $latitude, $longitude, $description);
$geo->setSource("Corrected manually");

$coords = $object->getLatLon(); // [ 54.0, 10.0]
echo $geo->getSource(); // "Corrected manually"
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


