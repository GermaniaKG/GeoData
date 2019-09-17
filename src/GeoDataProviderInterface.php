<?php
namespace Germania\GeoData;

interface GeoDataProviderInterface
{

    /**
     * @return null|GeoDataInterface
     */
    public function getGeoData() : ?GeoDataInterface;

}
