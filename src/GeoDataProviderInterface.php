<?php
namespace Germania\GeoData;

interface GeoDataProviderInterface
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
