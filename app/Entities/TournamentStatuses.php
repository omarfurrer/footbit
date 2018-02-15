<?php

namespace App\Entities;

use App\Services\Traits\Enumerable;

class TournamentStatuses {

    use Enumerable;

    const PENDING_TEAMS = 0;
    const READY = 1;
    const STARTED = 2;
    const FINISHED = 3;
    const EXPIRED = 4;

}
