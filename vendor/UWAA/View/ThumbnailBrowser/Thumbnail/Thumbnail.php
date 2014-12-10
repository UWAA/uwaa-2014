<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

interface Thumbnail
{
	function extractPostInformation($query);
	function buildTemplate();

}