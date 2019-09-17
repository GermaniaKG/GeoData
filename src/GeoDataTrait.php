<?php
namespace Germania\GeoData;

trait GeoDataTrait
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
     * @return float
     */
    public function getLatitude() : ?float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude() : ?float
    {
        return $this->longitude;
    }


    /**
     * @return array[float]
     */
    public function getLatLon() : array
    {
        return array(
            $this->getLatitude(),
            $this->getLongitude()
        );
    }

}
