<?php

namespace Excessive\GiantBombAPI;

class Game
{
    protected $name;
    protected $deck;
    protected $id;

    protected $images = [];
    protected $platforms = [];

    const IMAGE = 'http://static.giantbomb.com';

    protected static $properties = [
        'name', 'deck', 'id',
    ];

    public function __construct(array $apiResponse)
    {
        foreach(self::$properties as $property)
            $this->$property = $apiResponse[$property];
       
        $this->name = $apiResponse['name'];
        if(is_array($apiResponse['platforms']))
            foreach($apiResponse['platforms'] as $platform)
                $this->platforms[] = new Platform($platform);

        if(is_array($apiResponse['image']))
            foreach($apiResponse['image'] as $image)
                $this->images[] = $image;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getDeck()
    {
        return $this->deck;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPlatforms()
    {
        return $this->platforms;
    }

    public function getImage()
    {
        return $this->images[0];
    }
}