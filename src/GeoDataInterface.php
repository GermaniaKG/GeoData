<?php
namespace Germania\GeoData;

interface GeoDataInterface
{
    /**
     * @return float|null
     */
    public function getLatitude() : ?float;

    /**
     * @return float|null
     */
    public function getLongitude() : ?float;

    /**
     * @return float[]
     */
    public function getLatLon() : array;

    /**
     * @return string|null
     */
    public function getSource() : ?string;

    /**
     * @return string|null
     */
    public function getStatus() : ?string;
}
