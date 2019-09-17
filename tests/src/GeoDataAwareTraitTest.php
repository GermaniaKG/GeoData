<?php
namespace tests;

use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataAwareTrait;
use Germania\GeoData\GeoDataProviderInterface;



class GeoDataAwareTraitTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideGeoData
     */
    public function testSetter($provider)
    {
        // Setup mocks
        $aware_mock = $this->getMockForTrait(GeoDataAwareTrait::class);

        $this->assertObjectHasAttribute('geodata', $aware_mock);
        $aware_mock->setGeoData( $provider );

        $geodata = $provider->getGeoData();

        $this->assertEquals( $geodata->getLatitude(), $aware_mock->getGeoData()->getLatitude());
        $this->assertEquals( $geodata->getLongitude(), $aware_mock->getGeoData()->getLongitude());
        $this->assertEquals( $geodata->getLatLon(), $aware_mock->getGeoData()->getLatLon());
    }


    public function testSetterWithNull()
    {
        // Setup mocks
        $aware_mock = $this->getMockForTrait(GeoDataAwareTrait::class);

        $this->assertObjectHasAttribute('geodata', $aware_mock);
        $aware_mock->setGeoData( null );

        $geodata = $aware_mock->getGeoData();
        $this->assertNull( $geodata );
    }



    public function provideGeoData()
    {
        $latitude  = 54;
        $longitude = 10;
        $latlon    = array( $latitude, $longitude );

        $geodata = new GeoData($latitude, $longitude);

        $provider_stub = $this->prophesize(GeoDataProviderInterface::class);
        $provider_stub->getGeoData()->willReturn( $geodata );

        return array(
            [ $geodata ],
            [ $provider_stub->reveal() ]
        );
    }
}
