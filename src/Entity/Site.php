<?php

namespace App\Entity;

class Site
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @param int $id
     * @param string $url
     */
    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }
}
