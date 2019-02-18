<?php
namespace tests;

use Germania\GeoData\NotEmptyGeoDataFilterIterator;
use Germania\GeoData\GeoDataProviderInterface;
use Germania\GeoData\GeoDataInterface;

class NotEmptyGeoDataFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideGeoData
     */
    public function testInstantiation( $data, $valid_status, $expected_count)
    {
        $sut = new NotEmptyGeoDataFilterIterator( $data, $valid_status );
        $this->assertEquals( $expected_count, iterator_count( $sut ));
    }


    public function provideGeoData()
    {
        $geodata_valid = $this->prophesize( GeoDataInterface::class );
        $geodata_valid->getLatitude()->willReturn( 10.0 );
        $geodata_valid->getLongitude()->willReturn( 54.0 );

        $geodata_valid_instance = $geodata_valid->reveal();

        $geodata_invalid1 = $this->prophesize( GeoDataInterface::class );
        $geodata_invalid1->getLatitude()->willReturn( null );
        $geodata_invalid1->getLongitude()->willReturn( 54.0 );

        $geodata_invalid2 = $this->prophesize( GeoDataInterface::class );
        $geodata_invalid2->getLatitude()->willReturn( 99 );
        $geodata_invalid2->getLongitude()->willReturn( null );

        $geodata_invalid3 = $this->prophesize( GeoDataInterface::class );
        $geodata_invalid3->getLatitude()->willReturn( null );
        $geodata_invalid3->getLongitude()->willReturn( null );

        $geodata_provider_mock = $this->prophesize( GeoDataProviderInterface::class );
        $geodata_provider_mock->getGeoData()->willReturn( $geodata_valid_instance );

        $mocks = array(
            $geodata_provider_mock->reveal(),
            $geodata_valid_instance,
            $geodata_invalid1->reveal(),
            $geodata_invalid2->reveal(),
            $geodata_invalid3->reveal(),
            "invalid_stuff_from_here",
            999,
            array("foo, bar"),
            (object) array("foo, bar")
        );

        $mocks_iterator = new \ArrayIterator( $mocks);

        // This is what we know from the above array
        $valid_count = 2;
        // so array count minus $valid_count must be the "inversion"
        $invalid_count = count($mocks) - $valid_count;

        return array(
            [ $mocks_iterator, true,  $valid_count ],
            [ $mocks_iterator, false, $invalid_count ],

            [ new IteratorAggregator($mocks_iterator ), true,  $valid_count ],
            [ new IteratorAggregator($mocks_iterator ), false, $invalid_count ]
        );
    }
}
