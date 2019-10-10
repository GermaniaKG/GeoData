<?php
namespace tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

use Germania\GeoData\GeoDataFactoryRuntimeException;
use Germania\GeoData\GuzzleGeoDataFactory;
use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataInterface;
use Germania\GeoData\GeoDataProviderInterface;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;

class GuzzleGeoDataFactoryTest extends \PHPUnit\Framework\TestCase
{


    public function testInstantiation( )
    {
        $client = $this->prophesize(GuzzleClient::class);
        $client_stub = $client->reveal();

        $sut = new GuzzleGeoDataFactory( $client_stub );
        $this->assertInstanceOf(LoggerAwareInterface::class, $sut);
    }


    public function testValidResult( )
    {
        // Prepare JsonApi Response
        $fullset = array(
            'latitude' => 54, 
            'longitude' => 10, 
            'source' => "Test case", 
            'status' => "OK"
        );
        $json_array_encoded = json_encode(array('data' => array('attributes' => $fullset)));

        // Prepare ResponseInterface
        $response = $this->prophesize( ResponseInterface::class );
        $response->getBody()->willReturn( $json_array_encoded );
        $response_stub = $response->reveal();        

        // Stub Guzzle 
        $client = $this->prophesize(GuzzleClient::class);
        $client->get( Argument::type('string'), Argument::type('array'))->willReturn( $response_stub );
        $client_stub = $client->reveal();

        // Setup SUT
        $sut = new GuzzleGeoDataFactory( $client_stub );
        $geodata_result = $sut->fromString("Kiel");

        // Eval
        $this->assertInstanceOf( GeoDataInterface::class, $geodata_result);
        $this->assertInstanceOf( GeoDataProviderInterface::class, $geodata_result);
    }


    public function testExceptionOnRequest( )
    {
        // Stub Guzzle 
        $client = $this->prophesize(GuzzleClient::class);
        $client->get( Argument::type('string'), Argument::type('array'))->willThrow( RequestException::class );
        $client_stub = $client->reveal();

        // Setup SUT
        $sut = new GuzzleGeoDataFactory( $client_stub );

        $this->expectException(GeoDataFactoryRuntimeException::class, $sut);
        $sut->fromString("Somehow invalid");

    }


    /**
     * @dataProvider provideInvalidResponses
     */
    public function testExceptionOnResponse( $invalid_response)
    {

        // Prepare ResponseInterface
        $response = $this->prophesize( ResponseInterface::class );
        $response->getBody()->willReturn( $invalid_response );
        $response_stub = $response->reveal();        

        // Stub Guzzle 
        $client = $this->prophesize(GuzzleClient::class);
        $client->get( Argument::type('string'), Argument::type('array'))->willReturn( $response_stub );
        $client_stub = $client->reveal();

        // Setup SUT
        $sut = new GuzzleGeoDataFactory( $client_stub );

        $this->expectException(GeoDataFactoryRuntimeException::class, $sut);
        $sut->fromString("Valid request but ereponse invalid");

    }


    public function provideInvalidResponses()
    {
        // Prepare JsonApi Response
        $fullset = array(
            'latitude' => 54, 
            'longitude' => 10, 
            'source' => "Test case", 
            'status' => "OK"
        );
        $missing_attributes = json_encode(array('data' => array('wrong_attributes' => $fullset)));    
        $invalid_attributes = json_encode(array('data' => array('attributes' => 42)));    
        $missing_data       = json_encode(array('invalid_data' => array('attributes' => $fullset)));    
        $invalid_data       = json_encode(array('data' => "some_string"));    

        return array(
            [ $missing_attributes ],
            [ $invalid_attributes ],
            [ $missing_data ],
            [ $invalid_data ],
            [ 42 ],
            [ "some_string"],            
        );
            
    }
}
