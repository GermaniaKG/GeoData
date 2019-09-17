<?php
namespace Germania\GeoData;

trait GeoDataAwareTrait
{

    use GeoDataProviderTrait;



    /**
     * @param null|GeoDataInterface
     * @return self
     */
    public function setGeoData( ?GeoDataProviderInterface $geodata ) : self
    {
        if ($geodata instanceOf GeoDataProviderInterface):
            $this->geodata = $geodata->getGeoData();
        else:
            $this->geodata = $geodata;
        endif;

        return $this;
    }

}
