<?php

namespace Germania\GeoData;

interface StringGeoDataFactoryInterface
{
    /**
     * @param  string $location The search term
     * @return GeoData
     */
    public function fromString(string $location): GeoData;  
}
