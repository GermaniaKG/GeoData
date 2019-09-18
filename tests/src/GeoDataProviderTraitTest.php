<?php
namespace tests;

use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataInterface;
use Germania\GeoData\GeoDataProviderInterface;
use Germania\GeoData\GeoDataProviderTrait;

class GeoDataProviderTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetter()
    {

        // Setup mocks
        $mock = $this->getMockForTrait(GeoDataProviderTrait::class);

        $latitude  = 54;
        $longitude = 10;
        $latlon    = array( $latitude, $longitude );

        $geodata_mock = $this->prophesize( GeoDataInterface::class );
        $geodata_mock->getLatitude()->willReturn( $latitude );
        $geodata_mock->getLongitude()->willReturn( $longitude );
        $geodata_mock->getLatLon()->willReturn( $latlon );

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('geodata', $mock);
        $this->assertInstanceOf( GeoDataInterface::class, $mock->getGeoData());

        // Now overwrite
        $mock->geodata  = $geodata_mock->reveal();

        $this->assertEquals( $latitude, $mock->getGeoData()->getLatitude());
        $this->assertEquals( $longitude, $mock->getGeoData()->getLongitude());


        $this->assertEquals( $latlon, $mock->getGeoData()->getLatLon());
    }
}
