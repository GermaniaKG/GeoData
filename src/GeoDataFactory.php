<?php
namespace Germania\GeoData;

class GeoDataFactory
{

	public function fromArray( array $geodata ) : GeoData
	{
		$latitude  = $geodata['latitude'] ?? null;
		$longitude = $geodata['longitude'] ?? null;
		$provider  = $geodata['provider'] ?? null;
		$status    = $geodata['status'] ?? null;

		return (new GeoData($latitude, $longitude, $provider))->setStatus( $status );		
	}
}