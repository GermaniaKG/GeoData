<?php
namespace Germania\GeoData;

class GeoData extends GeoDataAbstract implements GeoDataInterface, GeoDataProviderInterface
{


    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct( ?float $latitude = null, ?float $longitude = null, ?string $source = null)
    {
        $this->setLatitude( $latitude );
        $this->setLongitude( $longitude );
        $this->setSource( $source );
    }


    public function setLatitude( ?float $latitude = null) : self
    {
        $this->latitude = $latitude;
        return $this;
    }


    public function setLongitude( ?float $longitude = null) : self
    {
        $this->longitude = $longitude;
        return $this;
    }


    public function setSource( ?string $source = null) : self
    {
        $this->source = $source;
        return $this;
    }


    public function setStatus( ?string $status = null) : self
    {
        $this->status = $status;
        return $this;
    }


    /**
     * @inheritDoc
     * @return self
     */
    public function getGeoData() : GeoDataInterface
    {
        return $this;
    }



}
