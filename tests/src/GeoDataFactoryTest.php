<?php
namespace tests;

use Germania\GeoData\GeoDataFactory;
use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataInterface;
use Germania\GeoData\GeoDataProviderInterface;
use Prophecy\PhpUnit\ProphecyTrait;

class GeoDataFactoryTest extends \PHPUnit\Framework\TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider provideArrayData
     */
    public function testInstantiation( array $geodata )
    {
        $sut = new GeoDataFactory;

        $geodata_result = $sut->fromArray( $geodata );

        $this->assertInstanceOf( GeoDataInterface::class, $geodata_result);
        $this->assertInstanceOf( GeoDataProviderInterface::class, $geodata_result);

        $this->assertEquals( $geodata['latitude'] ?? null, $geodata_result->getLatitude());
        $this->assertEquals( $geodata['longitude'] ?? null, $geodata_result->getLongitude());
        $this->assertEquals( $geodata['provider'] ?? null, $geodata_result->getSource());
        $this->assertEquals( $geodata['status'] ?? null, $geodata_result->getStatus());
    }


    public function provideArrayData()
    {
        $fullset = array(
            'latitude' => 54, 
            'longitude' => 10, 
            'source' => "Test case", 
            'status' => "OK"
        );
        return array(
            [  $fullset ]
        );
    }
}
