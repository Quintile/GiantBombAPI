<?php

namespace Excessive\GiantBombAPI;

class Game
{
    protected $name;

    public function __construct(array $apiResponse)
    {
        $this->name = $apiResponse['name'];
    }

    public function getName()
    {
        return $this->name;
    }
}