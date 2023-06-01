<?php

namespace App\Services;

use App\Exceptions\PharmacyException;

class PharmacyService
{
    /**
     * Formula saca de
     * https://en.wikipedia.org/wiki/Haversine_formula
     *
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @return float
     */
    public function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        if (!$lat1 || !$lon1)
            throw new PharmacyException('La latitud o la longitud de la farmacia no están presentes.');

        $r = 6371000;
        $phi1 = deg2rad($lat1);
        $phi2 = deg2rad($lat2);
        $deltaPhi = deg2rad($lat2 - $lat1);
        $deltaLambda = deg2rad($lon2 - $lon1);

        $a = sin($deltaPhi / 2) * sin($deltaPhi / 2) + cos($phi1) * cos($phi2) * sin($deltaLambda / 2) * sin($deltaLambda / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $r * $c;

        return $distance;
    }
}
