<?php
namespace Germania\GeoData;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Germania\GeoData\GeoData;
use Germania\GeoData\GeoDataFactory;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;


class GuzzleGeoDataFactory implements LoggerAwareInterface
{

	use LoggerAwareTrait;

	/**
	 * @var \GuzzleHttp\Client
	 */
	public $http_client;


	/**
	 * @var string
	 */
	public $url_path = "coordinates";


	/**
	 * @var GeoDataFactory
	 */
	public $geodata_factory;


	/**
	 * @param GuzzleClient    $http_client Guzzle Client, configured for Germania's GeoCoder API
	 * @param LoggerInterface $logger          PSR-3 Logger
	 */
	public function __construct(GuzzleClient $http_client, LoggerInterface $logger = null)
	{
		$this->http_client = $http_client;
		$this->geodata_factory = new GeoDataFactory;
		$this->setLogger($logger ?: new NullLogger);
	}


	/**
	 * @param  string $location [description]
	 * @return GeoData
	 * @throws \RuntimeException
	 */
	public function fromString( string $location ) : GeoData
	{
		try {
			// Guzzle client returns ResponseInterface!
			$response = $this->http_client->get( $this->url_path, [
				"query" => ['search' => $location]
			]);
		}
		catch (RequestException $e) {
			$msg = sprintf("Error on Geocoder API request: %s", $e->getMessage());
			$this->logger->log( "error", $msg, [
				'exception' => get_class($e)
			]);
			throw new GeoDataFactoryRuntimeException($msg, 0, $e);
		}		



		try {
			$response_body = $response->getBody();
			$response_body_decoded = json_decode($response_body, "associative");
			$this->validateDecodedResponse( $response_body_decoded );	
		}
		catch (\Throwable $e) {
			$msg = sprintf("Error on Geocoder API response validation: %s", $e->getMessage());			
			$this->logger->log( "error", $msg, [
				'exception' => get_class($e)
			]);
			throw new GeoDataFactoryRuntimeException($msg, 0, $e);
		}

			
		$coordinates_raw = $response_body_decoded['data']["attributes"];
		$geodata = $this->geodata_factory->fromArray( $coordinates_raw );


		return $geodata;
	}




	/**
	 * Validates the decoded response, throwing things in error case.
	 * 
	 * @param  mixed $response_body_decoded
	 * @return void
	 *
	 * @throws UnexpectedValueException
	 */
	protected function validateDecodedResponse( $response_body_decoded )
	{
		// "data" is quite common in JsonAPI responses, 
		// however, we need it as array.

		if (!is_array( $response_body_decoded )):
			throw new \UnexpectedValueException("GeocoderAPI response: Expected array");
		endif;

		if (!isset( $response_body_decoded['data'] )):
			throw new \UnexpectedValueException("GeocoderAPI response: Missing 'data' element");
		endif;

		if (!is_array( $response_body_decoded['data'] )):
			throw new \UnexpectedValueException("GeocoderAPI response: Element 'data' is not array");
		endif;

		if (!isset( $response_body_decoded['data']["attributes"] )):
			throw new \UnexpectedValueException("GeocoderAPI response: Missing 'data.attributes' element");
		endif;

		if (!is_array( $response_body_decoded['data']["attributes"] )):
			throw new \UnexpectedValueException("GeocoderAPI response: Element 'data.attributes' is not array");
		endif;

	}		
}