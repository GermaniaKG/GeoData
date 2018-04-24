<?php
namespace tests;

use Germania\GeoData\NotEmptyGeoDataFilterIterator;
use Germania\GeoData\GeoDataProviderInterface;

class NotEmptyGeoDataFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideGeoData
     */
    public function testInstantiation( $data, $expected_count)
    {

        $sut = new NotEmptyGeoDataFilterIterator( $data );
        $this->assertEquals( $expected_count, iterator_count( $sut ));

    }

    public function provideGeoData()
    {
        $geodata_valid = $this->prophesize( GeoDataProviderInterface::class );
        $geodata_valid->getLatitude()->willReturn( 10.0 );
        $geodata_valid->getLongitude()->willReturn( 54.0 );

        $geodata_invalid1 = $this->prophesize( GeoDataProviderInterface::class );
        $geodata_invalid1->getLatitude()->willReturn( null );
        $geodata_invalid1->getLongitude()->willReturn( 54.0 );

        $geodata_invalid2 = $this->prophesize( GeoDataProviderInterface::class );
        $geodata_invalid2->getLatitude()->willReturn( 99 );
        $geodata_invalid2->getLongitude()->willReturn( null );

        $geodata_invalid3 = $this->prophesize( GeoDataProviderInterface::class );
        $geodata_invalid3->getLatitude()->willReturn( null );
        $geodata_invalid3->getLongitude()->willReturn( null );

        $mocks = array(
            $geodata_valid->reveal(),
            $geodata_invalid1->reveal(),
            $geodata_invalid2->reveal(),
            $geodata_invalid3->reveal(),
            "invalid_stuff_from_here",
            999,
            array("foo, bar"),
            (object) array("foo, bar")
        );

        $mocks_iterator = new \ArrayIterator( $mocks);

        return array(
            [ $mocks_iterator, 1 ],
            [ new IteratorAggregator($mocks_iterator ), 1]
        );
    }
}
