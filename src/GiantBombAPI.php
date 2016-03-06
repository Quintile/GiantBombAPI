<?php

namespace Excessive\GiantBombAPI;

use GuzzleHttp\Client;

class GiantBombAPI
{
    protected $key = null;

    protected $client = null;

    const API_ENDPOINT = 'http://www.giantbomb.com/api/';

    public function __construct($key)
    {
        $this->key = $key;
        $this->client = new Client([
            'base_uri'  => self::API_ENDPOINT,
        ]);
    }

    public function search($term)
    {
        $response = $this->request('games/', [
            'filter' => 'name:'.$term,
        ]);

        $results = [];
        $object = json_decode($response, true);
        foreach($object['results'] as $result)
            $results[] = new Game($result);

        return $results;
    }

    protected function request($resource, array $query = array())
    {
        $query = array_merge([
            'api_key'   => $this->key,
            'format'    => 'json',
        ], $query);

        $result = $this->client->request('GET', $resource, [
            'query' => $query,
        ]);

        return (string) $result->getBody();
    }
}