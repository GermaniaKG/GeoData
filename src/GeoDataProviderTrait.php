<?php
namespace Germania\GeoData;

trait GeoDataProviderTrait
{

    /**
     * @var GeoDataInterface
     */
    public $geodata;


    /**
     * @return null|GeoDataInterface
     */
    public function getGeoData()
    {
        return $this->geodata;
    }


}
