<?php
namespace Germania\GeoData;

trait GeoDataAwareTrait
{

    use GeoDataProviderTrait;



    /**
     * @param GeoDataInterface
     * @return self
     */
    public function setGeoData( $geodata ) : self
    {
        if ($geodata instanceOf GeoDataInterface):
            $this->geodata = $geodata;
        elseif ($geodata instanceOf GeoDataProviderInterface):
            $this->geodata = $geodata->getGeoData();
        else:
            throw new \InvalidArgumentException("GeoDataInterface or GeoDataProviderInterface expected");
        endif;

        return $this;
    }

}
