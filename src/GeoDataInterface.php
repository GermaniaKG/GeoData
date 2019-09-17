<?php
namespace Germania\GeoData;

interface GeoDataInterface
{
    /**
     * @return float
     */
    public function getLatitude() : ?float;

    /**
     * @return float
     */
    public function getLongitude() : ?float;

    /**
     * @return array[float]
     */
    public function getLatLon() : array;
}
