<?php
namespace tests;

use Germania\GeoData\GeoDataInterface;
use Germania\GeoData\GeoDataTrait;

class GeoDataTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetter()
    {
        $mock = $this->getMockForTrait(GeoDataTrait::class);

        $latitude  = 54;
        $longitude = 10;

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('latitude', $mock);
        $this->assertObjectHasAttribute('longitude', $mock);

        $mock->latitude  = $latitude;
        $mock->longitude = $longitude;

        $this->assertEquals( $latitude, $mock->getLatitude());
        $this->assertEquals( $longitude, $mock->getLongitude());

        $latlon = [
            $latitude,
            $longitude
        ];
        $this->assertEquals( $latlon, $mock->getLatLon());
    }
}
