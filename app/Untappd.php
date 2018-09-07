<?php

namespace App;

use GuzzleHttp\Client;

class Untappd
{
	private $uri, $client;

	public function __construct($uri) {
		$this->uri = $uri;
		$this->client = $this->client();
	}

	/**
	 * Search for a Brewery
	 */
	public function brewery($brewery)
	{
		return $this->send($brewery);
	}

	/**
	 * Get info for a known brewery
	 */
	public function breweryInfo($id)
	{
		$this->uri .= "/" . $id;
		return $this->send('')->response->brewery;
	}

	/**
	 * Search for a Beer
	 */
	public function beer($beer)
	{
		return $this->send($beer);
	}

	/**
	 * Send a Guzzle request
	 */
    private function send($query)
    {
    	$response = $this->client->request('GET', $this->uri, [
		    'query' => [
		    	'client_id' => config('untappd.client'),
		    	'client_secret' => config('untappd.secret'),
		    	'q' => $query
		    ]
		]);

		return json_decode($response->getBody()->getContents());
    }

    /**
     * Create a guzzle http client
     */
    private function client()
    {
    	return new Client([
		    'base_uri' => config('untappd.base_uri')
		]);
    }
}
