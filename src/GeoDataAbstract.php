<?php
namespace Germania\GeoData;

abstract class GeoDataAbstract implements GeoDataInterface
{


    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;


    /**
     * @inheritDoc
     */
    public function getLatitude() : ?float
    {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     */
    public function getLongitude() : ?float
    {
        return $this->longitude;
    }


    /**
     * @inheritDoc
     */
    public function getLatLon() : array
    {
        return array(
            $this->getLatitude(),
            $this->getLongitude()
        );
    }

}
