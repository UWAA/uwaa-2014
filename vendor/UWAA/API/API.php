<?php namespace UWAA\API;


class API
{
	public function buildEndpoint($query, DataEndpoint\DataEndpoint $dataEndpoint)
	{
        header('Access-Control-Allow-Origin: *');
    	$endpointData = $dataEndpoint->load($query);
    	$dataEndpoint->build($endpointData);
	}
}
