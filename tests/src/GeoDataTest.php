<?php
namespace tests;

use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataInterface;
use Germania\GeoData\GeoDataProviderInterface;

class GeoDataTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation()
    {
        $latitude  = 54;
        $longitude = 10;
        $latlon    = array( $latitude, $longitude );

        $sut = new GeoData( $latitude, $longitude );

        $this->assertInstanceOf( GeoDataInterface::class, $sut);
        $this->assertInstanceOf( GeoDataProviderInterface::class, $sut);
        $this->assertInstanceOf( \JsonSerializable::class, $sut);
        $this->assertIsArray( $sut->jsonSerialize() );
    }


    public function testMethods()
    {
        $latitude  = 54;
        $longitude = 10;
        $latlon    = array( $latitude, $longitude );

        $sut = new GeoData( $latitude, $longitude );

        $this->assertEquals( $sut->getLatitude(), $latitude);
        $this->assertEquals( $sut->getLongitude(), $longitude);
        $this->assertEquals( $latlon, $sut->getLatLon());
        $this->assertInstanceOf( GeoDataInterface::class, $sut->getGeoData() );
    }


    public function testSourceMethods()
    {
        $sut = new GeoData;

        $source = "foobar";
        $sut->setSource( $source);

        $this->assertEquals( $source, $sut->getSource());
    }

    public function testStatusMethods()
    {
        $sut = new GeoData;

        $status = "foobar";
        $sut->setStatus( $status);

        $this->assertEquals( $status, $sut->getStatus());
    }
}
