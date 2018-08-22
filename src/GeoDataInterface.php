<?php
namespace Germania\GeoData;

interface GeoDataInterface
{
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
}
