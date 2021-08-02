<?php

namespace App\Entity;

class Destination
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $countryName;

    /**
     * @var string
     */
    public $conjunction;

    /**
     * @var
     */
    public $name;

    /**
     * @var string
     */
    public $computerName;

    /**
     * @param int $id
     * @param string $countryName
     * @param string $conjunction
     * @param string $computerName
     */
    public function __construct($id, $countryName, $conjunction, $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }
}
