<?php
namespace Germania\GeoData;

interface GeoDataAwareInterface
{

    /**
     * @param null|GeoDataProviderInterface
     * @return self
     */
    public function setGeoData( ?GeoDataProviderInterface $geodata ) : self;

}
