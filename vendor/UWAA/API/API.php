<?php namespace UWAA\API;


class API
{
	public function buildEndpoint($query, DataEndpoint\DataEndpoint $dataEndpoint)
	{
    	$endpointData = $dataEndpoint->load($query);
    	$dataEndpoint->build($endpointData);
	}
}