<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------




# Germania KG · GeoData

[![Packagist](https://img.shields.io/packagist/v/germania-kg/geodata.svg?style=flat)](https://packagist.org/packages/germania-kg/geodata)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/geodata.svg)](https://packagist.org/packages/germania-kg/geodata)
[![Tests](https://github.com/GermaniaKG/GeoData/actions/workflows/tests.yml/badge.svg)](https://github.com/GermaniaKG/GeoData/actions/workflows/tests.yml)



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

/**
 * @return string|null
 */
public function getStatus();
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
$get->setStatus("Not too exact");

$coords = $object->getLatLon(); // [ 54.0, 10.0]
echo $geo->getSource(); // "Corrected manually"
```



## Factories

### GeoDataFactory

The **GeoDataFactory** class provides a *fromArray* method:

```php
<?php
use Germania\GeoData\GeoDataFactory;  
use Germania\GeoData\GeoData;  

$factory = new GeoDataFactory;

// All these fields default to null
$geodata = $factory([
  'latitude'  => 54, 
  'longitude' => 10, 
  'source' => "Test case", 
  'status' => "OK"  
]);
```



### GuzzleGeoDataFactory

The **GuzzleGeoDataFactory** is a client for Germania's Geocoding API. It implements **StringGeoDataFactoryInterface** and requires Guzzle, configured to ask Germania's GeoCoder API. 

*Sorry, the API is not public.* You may use the Factory class to cook your own HTTP-client-based GeoData factory.

```php
<?php
use Germania\GeoData\GuzzleGeoDataFactory;
use GuzzleHttp\Client as GuzzleClient;

$guzzle = new GuzzleClient( ... );
$factory = new GuzzleGeoDataFactory($guzzle);

$geodata = $factory->fromString("Musterstraße 1, 12345 Musterstadt");
echo get_class( $geodata ); // Germania\GeoData\GeoData
```

**Exceptions:** Just in case the Guzzle client throws an exception or the API response is invalid, watch out for these:

```php
<?php
use Germania\GeoData\GeoDataExceptionInterface;
use Germania\GeoData\GeoDataFactoryRuntimeException;

// For 404 ClientExceptions, extends GeoDataFactoryRuntimeException
use Germania\GeoData\GeoDataFactoryNotFoundException;
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

