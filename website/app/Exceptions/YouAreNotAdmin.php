<?php

namespace App\Exceptions;

use Exception;

class YouAreNotAdmin extends Exception
{
public function render()
    {
        return ['data' => 'YouAreNotAdmin'];
    }
}
