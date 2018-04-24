# Germania KG · GeoData

[![Build Status](https://travis-ci.org/GermaniaKG/GeoData.svg?branch=master)](https://travis-ci.org/GermaniaKG/GeoData)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/GeoData/?branch=master)
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

The **GeoDataProviderTrait** provides public **latitude** and **longitude** properties as well as the methods 
prescribed by **GeoDataProviderInterface:**

```php
<?php
use Germania\GeoData\GeoDataProviderTrait;

class MyClass
{
	use GeoDataProviderTrait;
}

$object = new MyClass;

// Properties
echo $object->latitude;
echo $object->longitude;

// GeoDataProviderInterface methods
echo $object->getLatitude();
echo $object->getLongitude();
$coords = $object->getLatLon();
```


## Filters

### NotEmptyGeoDataFilterIterator

Accepts any **Traversable** and filters for **GeoDataProviderInterface** items whose *getLatitude* and *getLongitude* results are not empty.
