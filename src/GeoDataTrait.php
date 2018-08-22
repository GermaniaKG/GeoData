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
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }


    /**
     * @return array[float]
     */
    public function getLatLon()
    {
        return array(
            $this->getLatitude(),
            $this->getLongitude()
        );
    }

}
