<?php

namespace Germania\GeoData;

interface GeoDataAwareInterface extends GeoDataProviderInterface
{
    /**
     * @param mixed GeoDataProviderInterface|GeoDataInterface
     * @return self
     */
    // public function setGeoData($geodata) : self;
    public function setGeoData($geodata);
}
