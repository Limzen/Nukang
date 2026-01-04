<?php

namespace App\Helpers;

class GeoHelper
{
    /**
     * Calculate distance between two coordinates using Haversine formula
     * 
     * @param float $latitudeFrom
     * @param float $longitudeFrom
     * @param float $latitudeTo
     * @param float $longitudeTo
     * @param int $earthRadius Radius in meters (default: 6371000)
     * @return float Distance in meters
     */
    public static function haversineDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        
        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) + 
            cos($latFrom) * cos($latTo) * 
            pow(sin($lonDelta / 2), 2)
        ));
        
        return $angle * $earthRadius;
    }
    
    /**
     * Calculate distance in kilometers
     */
    public static function haversineDistanceKm($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        return self::haversineDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) / 1000;
    }
}
