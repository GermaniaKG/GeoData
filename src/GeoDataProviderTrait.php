<?php

namespace Germania\GeoData;

trait GeoDataProviderTrait
{
    /**
     * @var GeoDataInterface
     */
    public $geodata;

    /**
     * The default GeoData class
     * @var string FQDN
     */
    public $php_geodata_class = GeoData::class;


    /**
     * @return GeoDataInterface
     */
    public function getGeoData(): GeoDataInterface
    {
        if (is_null($this->geodata)) {
            $this->geodata = new $this->php_geodata_class();
        }

        return $this->geodata;
    }
}
