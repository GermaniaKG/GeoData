<?php
namespace Germania\GeoData;

interface GeoDataAwareInterface extends GeoDataProviderInterface
{

    /**
     * @param null|GeoDataProviderInterface
     * @return self
     */
    public function setGeoData( ?GeoDataProviderInterface $geodata ) : self;

}
