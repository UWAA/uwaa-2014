<?php namespace UWAA\API\DataEndpoint;


interface DataEndpoint {
    public function load($query);
    public function build($endpointData);
}