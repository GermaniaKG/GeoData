<?php
namespace Germania\GeoData;

class GeoData extends GeoDataAbstract implements GeoDataInterface, GeoDataProviderInterface
{


    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct( ?float $latitude = null, ?float $longitude = null)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }


    /**
     * @inheritDoc
     * @return self
     */
    public function getGeoData() : ?GeoDataInterface
    {
        return $this;
    }

}
