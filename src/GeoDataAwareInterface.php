<?php
namespace Germania\GeoData;

interface GeoDataAwareInterface extends GeoDataProviderInterface
{

    /**
     * @param GeoDataProviderInterface
     * @return self
     */
    public function setGeoData( GeoDataProviderInterface $geodata ) : self;

}
