<?php

namespace Excessive\GiantBombAPI;

use GuzzleHttp\Client;

class GiantBombAPI
{
    protected $key = null;

    protected $client = null;

    const API_ENDPOINT = 'http://www.giantbomb.com/api/';
    const API_DETAILS = 'game/3030-';

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
        foreach($response['results'] as $result)
            $results[] = new Game($result);

        return $results;
    }

    public function details($id)
    {
        $response = $this->request(self::API_DETAILS.$id);

        return new Game($response['results']);
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

        return json_decode((string) $result->getBody(), true);
    }
}