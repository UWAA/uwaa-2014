<?php namespace UWAA\API;


class API
{
	public function buildEndpoint($query, DataEndpoint\DataEndpoint $dataEndpoint)
	{
		$http_origin = $_SERVER['HTTP_HOST'];		
		$isHTTPS = ($_SERVER['HTTPS'] = 'on' ? 'https' :'http');

		if ($http_origin == "uwalum.test" || $http_origin == "washington.edu" || $http_origin == "uw.edu") {

			header('Access-Control-Allow-Origin: '. site_url( '/', $isHTTPS). ' ');
			header('Access-Control-Allow-Methods: GET');
						
			
		}
		header('Access-Control-Allow-Origin: '. site_url( '/', $isHTTPS). ' ');
    	$endpointData = $dataEndpoint->load($query);
    	$dataEndpoint->build($endpointData);
	}	
}
