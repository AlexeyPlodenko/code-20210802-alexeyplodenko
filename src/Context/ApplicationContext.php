<?php

namespace App\Context;

use App\Entity\Site;
use App\Entity\User;
use App\Helper\SingletonTrait;
use Faker\Factory;

class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var Site
     */
    private $currentSite;

    /**
     * @var User
     */
    private $currentUser;

    /**
     * Constructor
     */
    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    /**
     * @return Site
     */
    public function getCurrentSite()
    {
        return $this->currentSite;
    }

    /**
     * @return User
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
