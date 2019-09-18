<?php
namespace Germania\GeoData;

interface GeoDataProviderInterface
{

    /**
     * @return GeoDataInterface
     */
    public function getGeoData() : GeoDataInterface;

}
