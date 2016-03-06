<?php

namespace Excessive\GiantBombAPI;

class Platform
{
    protected $api_detail_url;

    protected $id;

    protected $name;

    protected $site_detail_url;

    protected $abbreviation;

    protected static $properties = [
        'api_detail_url',
        'id',
        'name',
        'site_detail_url',
        'abbreviation',
    ];

    public function __construct(array $apiResponse)
    {
        foreach(self::$properties as $property)
            if(array_key_exists($property, $apiResponse))
                $this->$property = $apiResponse[$property];
    }

    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getID()
    {
        return $this->id;
    }
}