<?php
namespace Germania\GeoData;

class GeoData extends GeoDataAbstract implements GeoDataInterface, GeoDataProviderInterface
{


    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct( $latitude, $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }


    /**
     * @inheritDoc
     */
    public function getGeoData()
    {
        return $this;
    }

}
