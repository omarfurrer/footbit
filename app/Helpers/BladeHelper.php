<?php

namespace App\Helpers;

use App\Entities\TournamentTypes;
use App\Entities\TournamentStatuses;

class BladeHelper {

    /**
     * Using the tournament type value. Get the type key in a displayable format. 
     * 
     * @param Integer $type
     * @return String
     */
    public static function displayTournamentType($type)
    {
        return ucfirst(strtolower(TournamentTypes::StringKeyByvalue($type)));
    }

    /**
     * Using the tournament status value. Get the status key in a displayable format. 
     * 
     * @param Integer $status
     * @return String
     */
    public static function displayTournamentStatus($status)
    {
        return ucfirst(strtolower(TournamentStatuses::StringKeyByvalue($status)));
    }

    /**
     * Using min and max age tournament properties. Get the displayable age group. 
     * 
     * @param mixed $minAge
     * @param mixed $maxAge
     * @return string
     */
    public static function displayTournamentAgeGroup($minAge, $maxAge)
    {
        if (!empty($minAge) && !empty($maxAge)) {
            $message = $minAge . ' to ' . $maxAge;
        } elseif (empty($minAge) && !empty($maxAge)) {
            $message = $maxAge . ' and below';
        } elseif (!empty($minAge) && empty($maxAge)) {
            $message = $minAge . ' and above';
        } else {
            $message = 'Any age group';
        }

        return $message;
    }

}
