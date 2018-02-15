<?php

namespace App\Entities;

class Venue {

    /**
     * Name of the venue.
     * 
     * @var String 
     */
    protected $name;

    /**
     * Address of the venue.
     *       
     * @var String 
     */
    protected $address;

    /**
     * Google Maps URL for the venue.
     * 
     * @var String 
     */
    protected $gmapsURL;

    /**
     * Array of images for that venue.
     * 
     * @var array 
     */
    protected $images;

    public function __construct()
    {
        
    }

}
