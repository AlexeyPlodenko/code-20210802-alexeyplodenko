<?php

namespace App\Repository;

interface Repository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);
}
