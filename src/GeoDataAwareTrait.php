<?php

namespace Germania\GeoData;

trait GeoDataAwareTrait
{
    use GeoDataProviderTrait;



    /**
     * @param GeoDataInterface|GeoDataProviderInterface
     * @return self
     */
    public function setGeoData($geodata) : self
    {
        if ($geodata instanceof GeoDataInterface):
            $this->geodata = $geodata; elseif ($geodata instanceof GeoDataProviderInterface):
            $this->geodata = $geodata->getGeoData(); else:
            throw new \InvalidArgumentException("GeoDataInterface or GeoDataProviderInterface expected");
        endif;

        return $this;
    }
}
