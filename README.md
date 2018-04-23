# Germania KG · GeoData

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

## Filters

### NotEmptyGeoDataFilterIterator

Accepts any **Traversable** and filters for **GeoDataProviderInterface** items whose *getLatitude* and *getLongitude* results are not empty.
