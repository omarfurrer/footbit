<?php

namespace App\Entities;

use App\Services\Traits\Enumerable;

class StatTypes {

    use Enumerable;

    const GOAL = 1;
    const CARD = 2;
    const PASS = 3;
    const BLOCK = 4;

}
